<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $cars = Car::where('available', true)
            ->inRandomOrder()
            ->limit(6)
            ->get();
            
        $reviews = Review::with(['car', 'user'])
            ->where('rating', '>=', 4)
            ->inRandomOrder()
            ->limit(6)
            ->get();
            
        return view('home', compact('cars', 'reviews'));
    }
}
