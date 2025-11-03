<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): Factory|View
    {
        $name = "ist";
        return view('frontend.home', compact('name'));
    }
}

