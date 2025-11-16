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
                @foreach(array_slice($products, 0, 3) as $product)
                <div class="bg-white/5 border border-cyan-500/20 rounded-2xl overflow-hidden hover:border-cyan-500/50 hover:shadow-2xl hover:shadow-cyan-500/20 transform hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                    <div class="relative h-64 bg-gradient-to-br from-slate-800 to-black flex items-center justify-center text-8xl">
                        {{ $product['image'] }}
                        @if($product['badge'])
                        <div class="absolute top-4 left-4 px-3 py-1 bg-cyan-500/30 backdrop-blur-xl border border-cyan-400/60 rounded-full text-xs font-bold text-cyan-300">
                            {{ $product['badge'] }}
                        </div>
                        @endif
                        @if($product['discount'] > 0)
                        <div class="absolute top-4 right-4 px-3 py-1 bg-red-500/30 backdrop-blur-xl border border-red-400/60 rounded-full text-xs font-bold text-red-300">
                            -{{ $product['discount'] }}%
                        </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <span class="text-cyan-400 text-xs font-bold uppercase tracking-wider">{{ $product['category'] }}</span>
                        <h3 class="text-xl font-bold text-white my-2">{{ $product['name'] }}</h3>
                        <p class="text-slate-400 text-sm mb-4">{{ $product['desc'] }}</p>

                        <div class="flex gap-4 text-xs text-slate-400 mb-4">
                            <div class="flex items-center gap-1">
                                <span>👤</span>
                                <span>{{ $product['specs']['seats'] }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span>⚙️</span>
                                <span>{{ $product['specs']['transmission'] }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span>⚡</span>
                                <span>{{ $product['specs']['fuel'] }}</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 mb-4">
                            @for($i = 0; $i < 5; $i++)
                            <span class="text-yellow-400">{{ $i < floor($product['rating']) ? '★' : '☆' }}</span>
                            @endfor
                            <span class="text-sm text-yellow-400 font-bold">{{ $product['rating'] }}</span>
                            <span class="text-xs text-slate-500">({{ $product['reviews'] }} reviews)</span>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-cyan-500/10 mb-4">
                            <div>
                                <p class="text-2xl font-black text-cyan-400">KES {{ number_format($product['price'] * (1 - $product['discount']/100)) }}</p>
                                @if($product['discount'] > 0)
                                <p class="text-xs text-slate-500 line-through">KES {{ number_format($product['price']) }}</p>
                                @endif
                            </div>
                        </div>

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                            <button type="submit" class="w-full py-3 bg-gradient-to-r from-cyan-500/50 to-blue-500/50 border border-cyan-400/60 rounded-lg font-bold hover:from-cyan-500/70 hover:to-blue-500/70 transform hover:scale-105 transition-all shadow-lg">
                                Book Now
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>

    @include('partials.footer')
</body>
</html>
