<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@zainmanufacturing.com'],
            [
                'name' => 'Zain Admin',
                'password' => Hash::make('120186'),
                'role' => 'admin',
            ]
        );
    }
}