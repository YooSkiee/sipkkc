<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun Manager
        User::create([
            'name' => 'Manager Kos Ginting',
            'email' => 'managerkos@ginting.com',
            'password' => Hash::make('managerkosd123.'),
            'role' => 'manager',
        ]);

        // Akun Admin
        User::create([
            'name' => 'Admin SIPKKC',
            'email' => 'adminkos@ginting.com',
            'password' => Hash::make('adminkos123'),
            'role' => 'admin',
        ]);
    }
}