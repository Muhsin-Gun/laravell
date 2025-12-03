<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query();

        // Search filter (DB-agnostic, use LIKE which is case-insensitive on MySQL by default)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('brand', 'LIKE', '%' . $search . '%')
                  ->orWhere('type', 'LIKE', '%' . $search . '%')
                  ->orWhere('description', 'LIKE', '%' . $search . '%');
            });
        }

        // Type filter (case-insensitive, use LIKE instead of LOWER for better MySQL support)
        if ($request->filled('type')) {
            $query->where('type', 'LIKE', $request->type);
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|max:5120', // adjust rules
        ]);

        $car = new Car();
        $car->name = $request->name;

        // handle image
        if ($request->hasFile('image')) {
            // store on public disk and save only 'cars/filename.jpg'
            $path = $request->file('image')->store('cars', 'public');
            $car->image_path = $path;
        }

        $car->save();
        return redirect()->route('admin.cars.index')->with('success', 'Car created');
    }
}
