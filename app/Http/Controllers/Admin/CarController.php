<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'type' => 'required',
            'price_per_day' => 'required|numeric',
            'image' => 'required|image'
        ]);

        $path = $request->file('image')->store('public/cars');

        Car::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'type' => $request->type,
            'description' => $request->description,
            'price_per_day' => $request->price_per_day,
            'image_path' => $path,
            'available' => true,
        ]);

        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'type' => 'required',
            'price_per_day' => 'required|numeric'
        ]);

        $car->update($request->only('name', 'brand', 'type', 'description', 'price_per_day', 'available'));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/cars');
            $car->image_path = $path;
            $car->save();
        }

        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted.');
    }
}
