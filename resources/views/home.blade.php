<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS - Premium Car Rentals</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">
    <div class="fixed inset-0 bg-gradient-to-br from-black via-slate-900 to-black"></div>

    @include('partials.header')

    <main class="relative z-10 pt-32 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h1 class="text-7xl font-black mb-6">
                    <span class="block bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-500 bg-clip-text text-transparent">Premium Car</span>
                    <span class="block">Services</span>
                </h1>
                <p class="text-xl text-slate-300 mb-8">Experience luxury travel with NEXUS - Your trusted partner for rentals, tours, and executive transfers</p>
                <a href="{{ route('marketplace') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl font-bold hover:scale-105 transform transition shadow-lg">
                    Explore Fleet
                </a>
            </div>

            <div class="grid md:grid-cols-4 gap-6 mb-20">
                <div class="p-8 bg-white/5 border border-cyan-500/20 rounded-2xl text-center hover:border-cyan-500/50 transition">
                    <div class="text-5xl mb-4">🚗</div>
                    <p class="text-slate-400 text-sm mb-2">Premium Vehicles</p>
                    <p class="text-3xl font-black text-cyan-400">500+</p>
                </div>
                <div class="p-8 bg-white/5 border border-cyan-500/20 rounded-2xl text-center hover:border-cyan-500/50 transition">
                    <div class="text-5xl mb-4">👥</div>
                    <p class="text-slate-400 text-sm mb-2">Happy Customers</p>
                    <p class="text-3xl font-black text-blue-400">50K+</p>
                </div>
                <div class="p-8 bg-white/5 border border-cyan-500/20 rounded-2xl text-center hover:border-cyan-500/50 transition">
                    <div class="text-5xl mb-4">⭐</div>
                    <p class="text-slate-400 text-sm mb-2">Average Rating</p>
                    <p class="text-3xl font-black text-purple-400">4.9/5</p>
                </div>
                <div class="p-8 bg-white/5 border border-cyan-500/20 rounded-2xl text-center hover:border-cyan-500/50 transition">
                    <div class="text-5xl mb-4">✈️</div>
                    <p class="text-slate-400 text-sm mb-2">Completed Trips</p>
                    <p class="text-3xl font-black text-pink-400">100K+</p>
                </div>
            </div>

            <div class="text-center mb-12">
                <h2 class="text-5xl font-black mb-4">
                    <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Featured Fleet</span>
                </h2>
                <p class="text-slate-400 text-lg">Handpicked luxury vehicles for unforgettable experiences</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-20">
                @foreach($cars as $car)
                <div class="bg-white/5 border border-cyan-500/20 rounded-2xl overflow-hidden hover:border-cyan-500/50 hover:shadow-2xl hover:shadow-cyan-500/20 transform hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                    <div class="relative h-64 bg-gradient-to-br from-slate-800 to-black flex items-center justify-center">
                        @if($car->image)
                            <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->make }} {{ $car->model }}" class="h-full w-full object-cover">
                        @else
                            <div class="text-8xl">🚗</div>
                        @endif
                        @if($car->featured)
                        <div class="absolute top-4 left-4 px-3 py-1 bg-cyan-500/30 backdrop-blur-xl border border-cyan-400/60 rounded-full text-xs font-bold text-cyan-300">
                            Featured
                        </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">{{ $car->year }} {{ $car->make }} {{ $car->model }}</h3>
                        <p class="text-slate-400 text-sm mb-4">{{ $car->description ?? 'Luxury vehicle for your comfort and style' }}</p>

                        <div class="flex gap-4 text-xs text-slate-400 mb-4">
                            <div class="flex items-center gap-1">
                                <span>👤</span>
                                <span>{{ $car->seats ?? 4 }} Seats</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span>⚙️</span>
                                <span>{{ $car->transmission ?? 'Automatic' }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span>⚡</span>
                                <span>{{ $car->fuel_type ?? 'Petrol' }}</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-2xl font-black">${{ number_format($car->price_per_day, 2) }}<span class="text-sm text-slate-400">/day</span></p>
                        </div>
                        <div class="flex justify-between items-center mt-4 pt-4 border-t border-slate-800">
                            <div class="flex items-center text-slate-400 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                24/7 Availability
                            </div>
                            <a href="{{ route('cars.show', $car->id) }}" class="text-cyan-400 hover:text-cyan-300 text-sm font-medium">View Details →</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>

    @include('partials.footer')
</body>
</html>
