<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $clientUser = User::where('role', 'client')->first();
        $userId = $clientUser ? $clientUser->id : 1;
        
        $cars = [
            [
                'name' => 'Mercedes-Benz S-Class',
                'brand' => 'Mercedes-Benz',
                'type' => 'Sedan',
                'description' => 'The ultimate luxury sedan with cutting-edge technology and unparalleled comfort. Perfect for business travel or special occasions.',
                'price_per_day' => 250,
                'image_path' => 'cars/luxury_car_sedan_d78ff9c8.jpg',
                'available' => true,
                'features' => json_encode(['Leather Seats', 'Navigation', 'Sunroof', 'Premium Sound']),
            ],
            [
                'name' => 'BMW 7 Series',
                'brand' => 'BMW',
                'type' => 'Sedan',
                'description' => 'Executive luxury meets dynamic performance. Experience the pinnacle of driving pleasure.',
                'price_per_day' => 230,
                'image_path' => 'cars/luxury_car_sedan_6a5d9a88.jpg',
                'available' => true,
                'features' => json_encode(['Heated Seats', 'Massage Function', 'Night Vision', 'WiFi']),
            ],
            [
                'name' => 'Audi A8',
                'brand' => 'Audi',
                'type' => 'Sedan',
                'description' => 'Progressive luxury with quattro all-wheel drive. Sophisticated design meets advanced technology.',
                'price_per_day' => 220,
                'image_path' => 'cars/luxury_car_sedan_57d27757.jpg',
                'available' => true,
                'features' => json_encode(['Virtual Cockpit', 'Matrix LED', 'B&O Sound', 'Air Suspension']),
            ],
            [
                'name' => 'Range Rover Sport',
                'brand' => 'Land Rover',
                'type' => 'SUV',
                'description' => 'Commanding presence with legendary off-road capability. Luxury meets adventure.',
                'price_per_day' => 280,
                'image_path' => 'cars/suv_car_6901cb19.jpg',
                'available' => true,
                'features' => json_encode(['Terrain Response', 'Meridian Sound', 'Panoramic Roof', 'Air Suspension']),
            ],
            [
                'name' => 'BMW X7',
                'brand' => 'BMW',
                'type' => 'SUV',
                'description' => 'The ultimate luxury SUV with spacious third-row seating and premium appointments.',
                'price_per_day' => 260,
                'image_path' => 'cars/suv_car_98251b6b.jpg',
                'available' => true,
                'features' => json_encode(['7 Seats', 'Gesture Control', 'Sky Lounge', 'Driving Assistant']),
            ],
            [
                'name' => 'Mercedes-Benz GLE',
                'brand' => 'Mercedes-Benz',
                'type' => 'SUV',
                'description' => 'Versatile luxury SUV with MBUX technology and exceptional comfort for all passengers.',
                'price_per_day' => 240,
                'image_path' => 'cars/suv_car_c3705c12.jpg',
                'available' => true,
                'features' => json_encode(['MBUX System', 'Burmester Audio', 'Active Suspension', 'Head-Up Display']),
            ],
            [
                'name' => 'Porsche 911',
                'brand' => 'Porsche',
                'type' => 'Coupe',
                'description' => 'Iconic sports car with legendary performance. Experience pure driving exhilaration.',
                'price_per_day' => 350,
                'image_path' => 'cars/sports_car_dd8c20ed.jpg',
                'available' => true,
                'features' => json_encode(['Sport Chrono', 'PDK Transmission', 'PASM', 'Sport Exhaust']),
            ],
            [
                'name' => 'Ferrari 488',
                'brand' => 'Ferrari',
                'type' => 'Coupe',
                'description' => 'Italian supercar with breathtaking performance and stunning design. Pure automotive passion.',
                'price_per_day' => 500,
                'image_path' => 'cars/sports_car_d350e7ae.jpg',
                'available' => true,
                'features' => json_encode(['V8 Twin-Turbo', 'Carbon Fiber', 'Race Mode', 'Launch Control']),
            ],
            [
                'name' => 'Ford F-150 Raptor',
                'brand' => 'Ford',
                'type' => 'Truck',
                'description' => 'High-performance off-road truck built for adventure. Unstoppable capability.',
                'price_per_day' => 180,
                'image_path' => 'cars/pickup_truck_97f4cea7.jpg',
                'available' => true,
                'features' => json_encode(['Fox Shocks', '4x4', 'Trail Control', 'SYNC 4']),
            ],
            [
                'name' => 'Toyota Hilux',
                'brand' => 'Toyota',
                'type' => 'Truck',
                'description' => 'Legendary reliability meets rugged capability. The truck that goes anywhere.',
                'price_per_day' => 120,
                'image_path' => 'cars/pickup_truck_806b0f21.jpg',
                'available' => true,
                'features' => json_encode(['Diesel Engine', '4WD', 'Tow Package', 'Safety Sense']),
            ],
        ];

        $reviewTexts = [
            ['Amazing car! The experience was fantastic. Will definitely rent again.', 5, 'Michael Johnson'],
            ['Great service and the car was in perfect condition.', 5, 'Sarah Williams'],
            ['Smooth rental process. The vehicle exceeded expectations.', 4, 'David Brown'],
            ['Excellent value for money. Highly recommended!', 5, 'Emily Davis'],
            ['Professional service from start to finish.', 4, 'James Wilson'],
            ['The car was clean and well-maintained. Great experience overall.', 5, 'Lisa Anderson'],
            ['Would definitely rent from NEXUS again. Top-notch service!', 5, 'Robert Martinez'],
        ];

        foreach ($cars as $carData) {
            $car = Car::firstOrCreate(
                ['name' => $carData['name']],
                $carData
            );
            
            if ($car->wasRecentlyCreated) {
                $numReviews = rand(2, 4);
                $selectedReviews = array_slice($reviewTexts, 0, $numReviews);
                
                foreach ($selectedReviews as $review) {
                    Review::create([
                        'car_id' => $car->id,
                        'user_id' => $userId,
                        'rating' => $review[1],
                        'comment' => $review[0],
                    ]);
                }
            }
        }
    }
}
