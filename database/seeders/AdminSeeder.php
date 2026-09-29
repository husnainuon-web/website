<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Don't create another admin if one already exists
        if (User::where('role', 'admin')->exists()) {
            return;
        }

        User::create([
            'name' => 'Zain Admin',
            'email' => 'admin@zainmanufacturing.com',
            'password' => Hash::make('Admin@12345'),
            'role' => 'admin',
        ]);
    }
}