<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Employ;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function createToken()
    {
        $user = User::first();
        return $user->createToken('authToken')->accessToken;
    }

    public function register(Request $request)
    {
        $request->validate(['email' => 'required', 'password' => 'required']);
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            switch ($user->role) {
                case 2:
                    $scope = 'employ';
                    break;
                case 3:
                    $scope = 'admin';
                    break;
                default:
                    $scope = 'user';
                    break;
            }
            $token = $user->createToken('JobSicle', [$scope])->accessToken;
            if ($token) {
                return response(['message' => 'Success', 'status' => Response::HTTP_OK, 'token' => $token]);
            }
            return response(['message' => 'Scope Creation Failed', 'status' => Response::HTTP_BAD_REQUEST]);
        }
        return response(['message' => "Email or Password wrong", 'status' => Response::HTTP_UNAUTHORIZED]);
    }

    public function userDashboard()
    {
        $users = User::all();
        $success = $users;
        return response()->json($success, 200);
    }

    public function employDashboard()
    {
        $users = Employ::all();
        $success = $users;
        return response()->json($success, 200);
    }

    public function adminDashboard()
    {
        $users = Admin::all();
        $success = $users;
        return response()->json($success, 200);
    }
}
