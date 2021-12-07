<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin@12123'),
            'role' => 3
        ]);
        User::create([
            'email' => 'employ@admin.com',
            'password' => Hash::make('admin@12123'),
            'role' => 2
        ]);
        User::create([
            'email' => 'user@admin.com',
            'password' => Hash::make('admin@12123'),
            'role' => 1
        ]);
        DB::table('admins')->insert([
            'name' => 'Admin Panel',
            'user_id' => 1
        ]);
    }
}
