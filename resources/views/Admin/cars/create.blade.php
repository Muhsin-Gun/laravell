@extends('layouts.dashboard')

@section('title', 'Create Car')
@section('page-title', 'Add New Car')

@section('content')
<div style="max-width: 700px;">
    <form method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data" style="background: #1a1a1a; border: 1px solid #333; border-radius: 12px; padding: 30px;">
        @csrf

        @if($errors->any())
            <div style="background: rgba(255,0,85,0.1); border: 1px solid rgba(255,0,85,0.3); color: #ff0055; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; color: #999; font-weight: 600;">Car Name *</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   style="width: 100%; padding: 12px; background: #0b0b0b; border: 1px solid #333; color: #fff; border-radius: 8px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; color: #999; font-weight: 600;">Brand *</label>
            <input type="text" name="brand" value="{{ old('brand') }}" required
                   style="width: 100%; padding: 12px; background: #0b0b0b; border: 1px solid #333; color: #fff; border-radius: 8px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; color: #999; font-weight: 600;">Type *</label>
            <select name="type" required style="width: 100%; padding: 12px; background: #0b0b0b; border: 1px solid #333; color: #fff; border-radius: 8px;">
                <option value="">Select Type</option>
                <option value="SUV">SUV</option>
                <option value="Sedan">Sedan</option>
                <option value="Truck">Truck</option>
                <option value="Coupe">Coupe</option>
                <option value="Hatchback">Hatchback</option>
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; color: #999; font-weight: 600;">Price Per Day (KSH) *</label>
            <input type="number" step="0.01" name="price_per_day" value="{{ old('price_per_day') }}" required
                   style="width: 100%; padding: 12px; background: #0b0b0b; border: 1px solid #333; color: #fff; border-radius: 8px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; color: #999; font-weight: 600;">Description</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 12px; background: #0b0b0b; border: 1px solid #333; color: #fff; border-radius: 8px;">{{ old('description') }}</textarea>
        </div>

        <div style="margin-bottom: 30px;">
            <label style="display: block; margin-bottom: 8px; color: #999; font-weight: 600;">Car Image *</label>
            <input type="file" name="image" accept="image/*" required
                   style="width: 100%; padding: 12px; background: #0b0b0b; border: 1px solid #333; color: #fff; border-radius: 8px;">
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn" style="padding: 12px 30px; flex: 1;">Create Car</button>
            <a href="{{ route('admin.cars.index') }}" class="btn" style="background: #333; padding: 12px 30px; text-decoration: none; text-align: center;">Cancel</a>
        </div>
    </form>
</div>
@endsection
