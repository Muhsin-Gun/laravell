<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query();

        // Search filter (case-insensitive using ILIKE for PostgreSQL)
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(brand) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(type) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(description) LIKE ?', ['%' . $search . '%']);
            });
        }

        // Type filter (case-insensitive)
        if ($request->filled('type')) {
            $query->whereRaw('LOWER(type) = ?', [strtolower($request->type)]);
        }

        // Price filter
        if ($request->filled('price_max')) {
            $query->where('price_per_day', '<=', (float)$request->price_max);
        }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price_per_day', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price_per_day', 'desc');
                    break;
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $cars = $query->paginate(12);
        return view('cars.index', compact('cars'));
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }
}
