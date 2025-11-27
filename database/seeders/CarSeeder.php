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
                'name' => 'Audi RS7',
                'brand' => 'Audi',
                'type' => 'Coupe',
                'description' => 'The Audi RS7 Sportback delivers breathtaking performance with its twin-turbo V8 engine, stunning design, and cutting-edge technology. A true masterpiece of German engineering.',
                'price_per_day' => 450,
                'image_path' => 'attached_assets/Audi rs7_1764238527799.jpg',
                'available' => true,
                'features' => json_encode(['Twin-Turbo V8', 'Quattro AWD', 'Bang & Olufsen Sound', 'Matrix LED', 'Sport Exhaust']),
            ],
            [
                'name' => 'Aston Martin DB12',
                'brand' => 'Aston Martin',
                'type' => 'Coupe',
                'description' => 'The Aston Martin DB12 is the world\'s first super tourer. Combining breathtaking power with elegant design, this British icon delivers an unforgettable driving experience.',
                'price_per_day' => 750,
                'image_path' => 'attached_assets/aston martin_1764239678089.jpg',
                'available' => true,
                'features' => json_encode(['V8 Twin-Turbo', 'Carbon Fiber', 'Premium Leather', 'B&O Audio', 'Sport Mode']),
            ],
            [
                'name' => 'BMW M8 Competition',
                'brand' => 'BMW',
                'type' => 'Coupe',
                'description' => 'The BMW M8 Competition Gran Coupe combines luxury with incredible performance. Its 4.4L V8 produces exhilarating power while delivering refined comfort.',
                'price_per_day' => 550,
                'image_path' => 'attached_assets/bmw m8_1764239697612.webp',
                'available' => true,
                'features' => json_encode(['V8 Twin-Turbo', 'M xDrive AWD', 'Bowers & Wilkins', 'Carbon Roof', 'M Sport Exhaust']),
            ],
            [
                'name' => 'Porsche Panamera Turbo S',
                'brand' => 'Porsche',
                'type' => 'Sedan',
                'description' => 'The Porsche Panamera Turbo S redefines luxury performance sedans. With its powerful twin-turbo V8 and race-inspired handling, it offers supercar thrills with four-door practicality.',
                'price_per_day' => 600,
                'image_path' => 'attached_assets/Porsche Panamera Turbo S_1764239741804.webp',
                'available' => true,
                'features' => json_encode(['Twin-Turbo V8', 'PASM Suspension', 'Burmester Audio', 'Sport Chrono', 'Panoramic Roof']),
            ],
            [
                'name' => 'Mercedes-AMG GT 63',
                'brand' => 'Mercedes-AMG',
                'type' => 'Coupe',
                'description' => 'The Mercedes-AMG GT 63 4-Door Coupe delivers jaw-dropping performance with its handcrafted 4.0L V8. Experience pure automotive excellence from the Affalterbach masters.',
                'price_per_day' => 650,
                'image_path' => 'attached_assets/mercedes AMG_1764239766474.avif',
                'available' => true,
                'features' => json_encode(['Handcrafted V8', 'AMG Performance 4MATIC+', 'Burmester 3D', 'AMG Track Pace', 'Carbon Package']),
            ],
            [
                'name' => 'Porsche 911 Carrera',
                'brand' => 'Porsche',
                'type' => 'Coupe',
                'description' => 'The iconic Porsche 911 Carrera - an automotive legend. Timeless design meets cutting-edge engineering for the ultimate sports car experience.',
                'price_per_day' => 500,
                'image_path' => 'attached_assets/porshe 911_1764239802606.webp',
                'available' => true,
                'features' => json_encode(['Twin-Turbo Flat-6', 'PDK Transmission', 'Sport Chrono', 'PASM', 'Sport Exhaust']),
            ],
            [
                'name' => 'Range Rover SVR',
                'brand' => 'Land Rover',
                'type' => 'SUV',
                'description' => 'The Range Rover Sport SVR is the ultimate performance SUV. Combining luxury, off-road capability, and supercar performance in one commanding package.',
                'price_per_day' => 550,
                'image_path' => 'attached_assets/range rover svr_1764239832725.jpg',
                'available' => true,
                'features' => json_encode(['Supercharged V8', 'Terrain Response', 'Meridian Signature', 'Dynamic Air Suspension', 'Carbon Fiber']),
            ],
        ];

        $reviewTexts = [
            ['Absolutely incredible! This car exceeded all expectations. The power and luxury are unmatched.', 5, 'Michael Johnson'],
            ['Best rental experience ever. The car was immaculate and performed flawlessly.', 5, 'Sarah Williams'],
            ['Smooth rental process. The vehicle exceeded expectations. Will book again!', 5, 'David Brown'],
            ['Excellent value for money. Highly recommended for anyone wanting luxury!', 5, 'Emily Davis'],
            ['Professional service from start to finish. The car was a dream to drive.', 5, 'James Wilson'],
            ['The car was clean and well-maintained. Great experience overall.', 5, 'Lisa Anderson'],
            ['Would definitely rent from NEXUS again. Top-notch service and amazing cars!', 5, 'Robert Martinez'],
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
