@extends('Admin.layout')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <h1 style="color: #00e5ff; margin-bottom: 30px;">Edit Car</h1>

    <div style="background: #1e1e1e; padding: 40px; border-radius: 12px; border: 1px solid #333;">
        <form method="POST" action="{{ route('admin.cars.update', $car) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <label style="display: block;">
                    <span style="display: block; margin-bottom: 8px; color: #999;">Name</span>
                    <input type="text" name="name" value="{{ $car->name }}" required>
                </label>

                <label style="display: block;">
                    <span style="display: block; margin-bottom: 8px; color: #999;">Brand</span>
                    <input type="text" name="brand" value="{{ $car->brand }}" required>
                </label>

                <label style="display: block;">
                    <span style="display: block; margin-bottom: 8px; color: #999;">Type</span>
                    <select name="type" required>
                        <option value="SUV" {{ $car->type == 'SUV' ? 'selected' : '' }}>SUV</option>
                        <option value="Sedan" {{ $car->type == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                        <option value="Truck" {{ $car->type == 'Truck' ? 'selected' : '' }}>Truck</option>
                        <option value="Coupe" {{ $car->type == 'Coupe' ? 'selected' : '' }}>Coupe</option>
                    </select>
                </label>

                <label style="display: block;">
                    <span style="display: block; margin-bottom: 8px; color: #999;">Price per Day ($)</span>
                    <input type="number" name="price_per_day" value="{{ $car->price_per_day }}" step="0.01" required>
                </label>
            </div>

            <label style="display: block; margin-top: 20px;">
                <span style="display: block; margin-bottom: 8px; color: #999;">Description</span>
                <textarea name="description" rows="4">{{ $car->description }}</textarea>
            </label>

            <label style="display: block; margin-top: 20px;">
                <span style="display: block; margin-bottom: 8px; color: #999;">Available</span>
                <input type="checkbox" name="available" {{ $car->available ? 'checked' : '' }} style="width: auto;">
            </label>

            <label style="display: block; margin-top: 20px;">
                <span style="display: block; margin-bottom: 8px; color: #999;">Image (leave empty to keep current)</span>
                <input type="file" name="image" accept="image/*">
            </label>

            <button type="submit" class="btn" style="width: 100%; margin-top: 30px; font-size: 18px;">Update Car</button>
        </form>
    </div>
</div>
@endsection
