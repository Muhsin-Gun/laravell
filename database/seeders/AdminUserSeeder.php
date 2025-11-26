<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@nexus.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );
        
        User::firstOrCreate(
            ['email' => 'employee@nexus.com'],
            [
                'name' => 'John Employee',
                'password' => Hash::make('password'),
                'role' => 'employee'
            ]
        );
        
        User::firstOrCreate(
            ['email' => 'client@nexus.com'],
            [
                'name' => 'Jane Client',
                'password' => Hash::make('password'),
                'role' => 'client'
            ]
        );
    }
}
