@extends('layouts.app')

@section('title','NEXUS - Premium Car Rentals')

@section('content')
    <div class="relative pt-16">
        <div class="text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight">
                <span class="block bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-500">Premium Car</span>
                <span class="block text-white">Rental Services</span>
            </h1>
            <p class="text-lg text-slate-300 mb-8 max-w-2xl mx-auto">Experience luxury travel with NEXUS - your trusted partner for premium rentals, tours, and executive transfers.</p>
            <a href="{{ route('cars.index') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl font-bold hover:scale-105 transform transition shadow-lg shadow-cyan-500/25">Explore Fleet</a>
        </div>

        <div class="grid md:grid-cols-4 gap-6 mb-20">
            <div class="p-8 bg-white/5 border border-cyan-500/10 rounded-2xl text-center hover:border-cyan-500/30 transition">
                <div class="text-5xl mb-4">🚗</div>
                <p class="text-slate-400 text-sm mb-2">Premium Vehicles</p>
                <p class="text-3xl font-black text-cyan-400">{{ $cars->count() * 50 }}+</p>
            </div>
            <div class="p-8 bg-white/5 border border-cyan-500/10 rounded-2xl text-center hover:border-cyan-500/30 transition">
                <div class="text-5xl mb-4">👥</div>
                <p class="text-slate-400 text-sm mb-2">Happy Customers</p>
                <p class="text-3xl font-black text-blue-400">50K+</p>
            </div>
            <div class="p-8 bg-white/5 border border-cyan-500/10 rounded-2xl text-center hover:border-cyan-500/30 transition">
                <div class="text-5xl mb-4">⭐</div>
                <p class="text-slate-400 text-sm mb-2">Average Rating</p>
                <p class="text-3xl font-black text-purple-400">4.9/5</p>
            </div>
            <div class="p-8 bg-white/5 border border-cyan-500/10 rounded-2xl text-center hover:border-cyan-500/30 transition">
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
            <div class="bg-white/3 border border-cyan-500/10 rounded-2xl overflow-hidden hover:border-cyan-500/30 transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="relative h-64 bg-gradient-to-br from-slate-800 to-black flex items-center justify-center overflow-hidden">
                    @if($car->image_path)
                        <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->name }}" class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="text-8xl">🚗</div>
                    @endif
                    @if($car->available)
                    <div class="absolute top-4 left-4 px-3 py-1 bg-green-500/30 backdrop-blur-xl border border-green-400/60 rounded-full text-xs font-bold text-green-300">Available</div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">{{ $car->name }}</h3>
                    <p class="text-slate-400 text-sm mb-1">{{ $car->brand }} • {{ $car->type }}</p>
                    <p class="text-slate-500 text-sm mb-4 line-clamp-2">{{ Str::limit($car->description, 80) }}</p>

                    <div class="flex justify-between items-center mt-4 pt-4 border-t border-slate-800">
                        <p class="text-2xl font-black">${{ number_format($car->price_per_day, 0) }}<span class="text-sm text-slate-400">/day</span></p>
                        <a href="{{ route('cars.show', $car->id) }}" class="px-4 py-2 bg-cyan-500/20 text-cyan-400 rounded-lg hover:bg-cyan-500/30 transition text-sm font-medium">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mb-8">
            <a href="{{ route('cars.index') }}" class="inline-block px-8 py-4 border border-cyan-500/30 text-cyan-400 rounded-xl font-bold hover:bg-cyan-500/10 transition">
                View All Vehicles →
            </a>
        </div>

        @if($reviews->count() > 0)
        <div class="mt-24 mb-20">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-4">Customer Reviews</h2>
                <p class="text-slate-400 text-lg">See what our customers say about us</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($reviews as $review)
                <div class="p-6 bg-white/5 border border-cyan-500/10 rounded-2xl hover:border-cyan-500/20 transition">
                    <div class="flex items-center gap-1 mb-4">
                        @for($i = 0; $i < $review->rating; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-slate-300 mb-4 italic">"{{ $review->comment }}"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center font-bold text-sm">
                            {{ substr($review->user->name ?? 'C', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-medium text-white">{{ $review->user->name ?? 'Customer' }}</p>
                            <p class="text-xs text-slate-400">{{ $review->car->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="mt-24 mb-10 bg-gradient-to-br from-cyan-500/10 to-blue-500/10 border border-cyan-500/20 rounded-3xl p-12 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Ready for Your Next Adventure?</h2>
            <p class="text-slate-400 text-lg mb-8 max-w-xl mx-auto">Book your dream car today and experience luxury travel like never before.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('cars.index') }}" class="px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl font-bold hover:scale-105 transform transition shadow-lg">Browse Fleet</a>
                <a href="{{ route('register') }}" class="px-8 py-4 border border-cyan-500/30 text-cyan-400 rounded-xl font-bold hover:bg-cyan-500/10 transition">Create Account</a>
            </div>
        </div>
    </div>
@endsection
