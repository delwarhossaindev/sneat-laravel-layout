<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            ['name' => 'Super Admin', 'password' => Hash::make('password')]
        );
        $superAdmin->syncRoles(['Admin']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => Hash::make('password')]
        );
        $admin->syncRoles(['Admin']);

        $manager = User::firstOrCreate(
            ['email' => 'manager@example.com'],
            ['name' => 'Manager User', 'password' => Hash::make('password')]
        );
        $manager->syncRoles(['Manager']);

        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            ['name' => 'Regular User', 'password' => Hash::make('password')]
        );
        $user->syncRoles(['User']);
    }
}
