<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('create-token', [\App\Http\Controllers\AuthController::class, 'createToken'])->name('createToken');
Route::post('register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::group(['prefix' => 'user', 'middleware' => ['auth:api-user', 'scopes:user']], function () {
    Route::get('dashboard', function () {
        return "JobSeeker Dashboard";
    });
});
Route::group(['prefix' => 'employ', 'middleware' => ['auth:api-employ', 'scopes:employ']], function () {
    Route::get('dashboard', function () {
        return "Employer Dashboard";
    });
});
Route::group(['prefix' => 'admin', 'middleware' => ['auth:api-admin', 'scopes:admin']], function () {
    Route::get('dashboard', function () {
        return "Admin Dashboard";
    });
});






























