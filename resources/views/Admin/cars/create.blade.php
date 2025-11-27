@extends('Admin.layout')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <h1 style="color: #00e5ff; margin-bottom: 30px;">Add New Car</h1>

    <div style="background: #1e1e1e; padding: 40px; border-radius: 12px; border: 1px solid #333;">
        <form method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <label style="display: block;">
                    <span style="display: block; margin-bottom: 8px; color: #999;">Name</span>
                    <input type="text" name="name" required>
                </label>

                <label style="display: block;">
                    <span style="display: block; margin-bottom: 8px; color: #999;">Brand</span>
                    <input type="text" name="brand" required>
                </label>

                <label style="display: block;">
                    <span style="display: block; margin-bottom: 8px; color: #999;">Type</span>
                    <select name="type" required>
                        <option value="">Select Type</option>
                        <option value="SUV">SUV</option>
                        <option value="Sedan">Sedan</option>
                        <option value="Truck">Truck</option>
                        <option value="Coupe">Coupe</option>
                    </select>
                </label>

                <label style="display: block;">
                    <span style="display: block; margin-bottom: 8px; color: #999;">Price per Day ($)</span>
                    <input type="number" name="price_per_day" step="0.01" required>
                </label>
            </div>

            <label style="display: block; margin-top: 20px;">
                <span style="display: block; margin-bottom: 8px; color: #999;">Description</span>
                <textarea name="description" rows="4"></textarea>
            </label>

            <label style="display: block; margin-top: 20px;">
                <span style="display: block; margin-bottom: 8px; color: #999;">Image</span>
                <input type="file" name="image" accept="image/*" required>
            </label>

            <button type="submit" class="btn" style="width: 100%; margin-top: 30px; font-size: 18px;">Create Car</button>
        </form>
    </div>
</div>
@endsection
