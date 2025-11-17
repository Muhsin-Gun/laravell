<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Car;
use Illuminate\Support\Facades\Hash;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@carrental.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'loyalty_points' => 0
        ]);

        // Create Employee User
        User::create([
            'name' => 'Employee User',
            'email' => 'employee@carrental.test',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'loyalty_points' => 0
        ]);

        // Create Client User
        User::create([
            'name' => 'Client User',
            'email' => 'client@carrental.test',
            'password' => Hash::make('password'),
            'role' => 'client',
            'loyalty_points' => 100
        ]);

        // Create Sample Cars
        Car::create([
            'name' => 'Phantom XR',
            'brand' => 'Zenith',
            'type' => 'SUV',
            'description' => 'Futuristic SUV with advanced features, 5 seats, AC, automatic transmission.',
            'price_per_day' => 120.00,
            'image_path' => null,
            'available' => true
        ]);

        Car::create([
            'name' => 'Crimson GT',
            'brand' => 'Aurora',
            'type' => 'Coupe',
            'description' => 'Sporty coupe with high performance engine and luxury interior.',
            'price_per_day' => 200.00,
            'image_path' => null,
            'available' => true
        ]);

        Car::create([
            'name' => 'Urban Cruiser',
            'brand' => 'Metro',
            'type' => 'Sedan',
            'description' => 'Comfortable sedan perfect for city driving and long trips.',
            'price_per_day' => 80.00,
            'image_path' => null,
            'available' => true
        ]);

        Car::create([
            'name' => 'Thunder Truck',
            'brand' => 'Titan',
            'type' => 'Truck',
            'description' => 'Powerful truck for heavy-duty tasks and off-road adventures.',
            'price_per_day' => 150.00,
            'image_path' => null,
            'available' => true
        ]);

        Car::create([
            'name' => 'Velocity Sport',
            'brand' => 'Apex',
            'type' => 'Coupe',
            'description' => 'High-speed sports car with cutting-edge technology.',
            'price_per_day' => 250.00,
            'image_path' => null,
            'available' => true
        ]);
    }
}
