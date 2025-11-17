<?php

namespace App\Http\Controllers;

use App\Models\Car;

class HomeController extends Controller
{
    public function index()
    {
        $cars = Car::inRandomOrder()->limit(5)->get();
        return view('home', compact('cars'));
    }
}
