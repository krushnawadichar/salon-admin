<?php
// database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'pabeloAdmin@salon.com',
            'password' => Hash::make('Pranay@123'),
            'role' => 'admin',
            'phone' => '1234567890'
        ]);
    }
}