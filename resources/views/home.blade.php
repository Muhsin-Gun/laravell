@extends('layouts.app')

@section('title','NEXUS - Premium Car Rentals')

@section('content')
    <div class="relative pt-16">
        <div class="text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight">
                <span class="block bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-500">Premium Car</span>
                <span class="block text-white">Services</span>
            </h1>
            <p class="text-lg text-slate-300 mb-8 max-w-2xl mx-auto">Experience luxury travel with NEXUS — trusted partner for rentals, tours, and executive transfers.</p>
            <a href="{{ Route::has('marketplace') ? route('marketplace') : route('cars.index') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl font-bold hover:scale-105 transform transition shadow-lg">Explore Fleet</a>
        </div>

        <div class="grid md:grid-cols-4 gap-6 mb-20">
            <div class="p-8 bg-white/5 border border-cyan-500/10 rounded-2xl text-center">
                <div class="text-5xl mb-4">🚗</div>
                <p class="text-slate-400 text-sm mb-2">Premium Vehicles</p>
                <p class="text-3xl font-black text-cyan-400">500+</p>
            </div>
            <div class="p-8 bg-white/5 border border-cyan-500/10 rounded-2xl text-center">
                <div class="text-5xl mb-4">👥</div>
                <p class="text-slate-400 text-sm mb-2">Happy Customers</p>
                <p class="text-3xl font-black text-blue-400">50K+</p>
            </div>
            <div class="p-8 bg-white/5 border border-cyan-500/10 rounded-2xl text-center">
                <div class="text-5xl mb-4">⭐</div>
                <p class="text-slate-400 text-sm mb-2">Average Rating</p>
                <p class="text-3xl font-black text-purple-400">4.9/5</p>
            </div>
            <div class="p-8 bg-white/5 border border-cyan-500/10 rounded-2xl text-center">
                <div class="text-5xl mb-4">✈️</div>
                <p class="text-slate-400 text-sm mb-2">Completed Trips</p>
                <p class="text-3xl font-black text-pink-400">100K+</p>
            </div>
        </div>

        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-4">Featured Fleet</h2>
            <p class="text-slate-400 text-lg">Handpicked luxury vehicles for unforgettable experiences</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mb-20">
            @foreach($cars as $car)
            <div class="bg-white/3 border border-cyan-500/10 rounded-2xl overflow-hidden hover:border-cyan-500/30 transform hover:-translate-y-2 transition-all duration-300">
                <div class="relative h-64 bg-gradient-to-br from-slate-800 to-black flex items-center justify-center">
                    @if($car->image_path)
                        <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->name }}" class="h-full w-full object-cover">
                    @else
                        <div class="text-8xl">🚗</div>
                    @endif
                    @if(property_exists($car,'featured') && $car->featured)
                    <div class="absolute top-4 left-4 px-3 py-1 bg-cyan-500/30 backdrop-blur-xl border border-cyan-400/60 rounded-full text-xs font-bold text-cyan-300">Featured</div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">{{ $car->name }} @if($car->brand) <span class="text-sm text-slate-400">• {{ $car->brand }}</span> @endif</h3>
                    <p class="text-slate-400 text-sm mb-4">{{ $car->description ?? 'Luxury vehicle for your comfort and style' }}</p>

                    <div class="flex justify-between items-center mt-4 pt-4 border-t border-slate-800">
                        <p class="text-2xl font-black">${{ number_format($car->price_per_day, 2) }}<span class="text-sm text-slate-400">/day</span></p>
                        <a href="{{ route('cars.show', $car->id) }}" class="text-cyan-400 hover:text-cyan-300 text-sm font-medium">View Details →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
