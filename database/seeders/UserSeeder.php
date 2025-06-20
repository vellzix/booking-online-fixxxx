<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'phone' => '081234567890',
            'role' => 'admin',
        ]);

        // Create regular user
        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
            'phone' => '081234567891',
            'role' => 'user',
        ]);
    }
}
