@extends('layouts.dashboard')

@section('title', 'Edit Car')
@section('role-badge', 'Admin')
@section('page-title', 'Edit Car')

@section('sidebar-menu')
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
        </svg>
        Dashboard
    </a>

    <a href="{{ route('admin.cars.index') }}" class="sidebar-link active flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 bg-cyan-500/10">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
        </svg>
        Manage Cars
    </a>

    <a href="{{ route('admin.users.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        Manage Users
    </a>

    <a href="{{ route('admin.blogs.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
        </svg>
        Manage Blogs
    </a>
@endsection

@section('content')
    <div class="mb-8">
        <a href="{{ route('admin.cars.index') }}" class="text-cyan-400 hover:text-cyan-300 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Cars
        </a>
    </div>

    <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-white mb-6">Edit Vehicle: {{ $car->name }}</h2>

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-500/20 border border-red-500/30 rounded-xl">
                <ul class="list-disc list-inside text-red-400">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Car Name</label>
                    <input type="text" name="name" value="{{ old('name', $car->name) }}" required class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand', $car->brand) }}" required class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Type</label>
                    <select name="type" required class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none transition">
                        <option value="">Select Type</option>
                        <option value="SUV" {{ old('type', $car->type) == 'SUV' ? 'selected' : '' }}>SUV</option>
                        <option value="Sedan" {{ old('type', $car->type) == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                        <option value="Truck" {{ old('type', $car->type) == 'Truck' ? 'selected' : '' }}>Truck</option>
                        <option value="Coupe" {{ old('type', $car->type) == 'Coupe' ? 'selected' : '' }}>Coupe</option>
                        <option value="Hatchback" {{ old('type', $car->type) == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                        <option value="Sports" {{ old('type', $car->type) == 'Sports' ? 'selected' : '' }}>Sports</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Price Per Day (KES)</label>
                    <input type="number" name="price_per_day" value="{{ old('price_per_day', $car->price_per_day) }}" required min="1" class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none transition">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-400 mb-2">Description</label>
                <textarea name="description" rows="4" class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none transition">{{ old('description', $car->description) }}</textarea>
            </div>

            <div class="mb-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="available" value="1" {{ old('available', $car->available) ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-700 bg-slate-900 text-cyan-500 focus:ring-cyan-500">
                    <span class="text-gray-300">Available for Booking</span>
                </label>
            </div>

            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-400 mb-2">Car Image (Leave empty to keep current)</label>
                @if($car->image_path)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->name }}" class="w-48 h-32 object-cover rounded-xl">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-cyan-500/20 file:text-cyan-400 file:cursor-pointer">
            </div>

            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-cyan-500/25 transition">
                Update Car
            </button>
        </form>
    </div>
@endsection
