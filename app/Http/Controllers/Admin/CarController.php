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
        return view('Admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('Admin.cars.create');
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

        $path = $request->file('image')->store('cars', 'public');

        Car::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'type' => $request->type,
            'description' => $request->description,
            'price_per_day' => $request->price_per_day,
            'image_path' => $path,
            'available' => true,
        ]);

        return redirect()->route('admin.cars.index')->with('success', 'Car created successfully.');
    }

    public function edit(Car $car)
    {
        return view('Admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'type' => 'required',
            'price_per_day' => 'required|numeric'
        ]);

        $data = $request->only('name', 'brand', 'type', 'description', 'price_per_day');
        $data['available'] = $request->has('available');
        $car->update($data);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cars', 'public');
            $car->image_path = $path;
            $car->save();
        }

        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Car deleted.');
    }
}
