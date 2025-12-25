<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@sejahtera.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Staff User
        User::create([
            'name' => 'Staff',
            'email' => 'staff@sejahtera.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        // Create Guest User
        User::create([
            'name' => 'Guest',
            'email' => 'guest@sejahtera.com',
            'password' => Hash::make('password'),
            'role' => 'guest',
        ]);
    }
}
