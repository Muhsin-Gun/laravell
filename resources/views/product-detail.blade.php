<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product['name'] }} - NEXUS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">
    <div class="fixed inset-0 bg-gradient-to-br from-black via-slate-900 to-black"></div>

    @include('partials.header')

    <main class="relative z-10 pt-32 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-20">
            <a href="{{ route('marketplace') }}" class="mb-8 text-cyan-400 hover:text-cyan-300 font-bold flex items-center gap-2 group inline-flex">
                <span class="transform group-hover:-translate-x-1 transition">←</span> Back to Fleet
            </a>

            <div class="grid md:grid-cols-2 gap-12">
                <div>
                    <div class="bg-gradient-to-br from-slate-800 to-black border border-cyan-500/20 rounded-2xl p-12 h-96 flex items-center justify-center text-9xl mb-4">
                        {{ $product['image'] }}
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <p class="text-cyan-400 text-sm font-bold uppercase mb-2 tracking-wider">{{ $product['category'] }}</p>
                        <h1 class="text-5xl font-black text-white mb-4">{{ $product['name'] }}</h1>
                        <p class="text-lg text-slate-300">{{ $product['desc'] }}</p>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-white/5 border border-cyan-500/10 rounded-lg p-4">
                            <p class="text-xs text-slate-400 mb-1">Seats</p>
                            <p class="font-bold text-white">{{ $product['specs']['seats'] }}</p>
                        </div>
                        <div class="bg-white/5 border border-cyan-500/10 rounded-lg p-4">
                            <p class="text-xs text-slate-400 mb-1">Transmission</p>
                            <p class="font-bold text-white">{{ $product['specs']['transmission'] }}</p>
                        </div>
                        <div class="bg-white/5 border border-cyan-500/10 rounded-lg p-4">
                            <p class="text-xs text-slate-400 mb-1">Fuel Type</p>
                            <p class="font-bold text-white">{{ $product['specs']['fuel'] }}</p>
                        </div>
                    </div>

                    <div class="bg-white/5 border border-cyan-500/10 rounded-xl p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="flex gap-1">
                                @for($i = 0; $i < 5; $i++)
                                <span class="text-yellow-400 text-xl">{{ $i < floor($product['rating']) ? '★' : '☆' }}</span>
                                @endfor
                            </div>
                            <p class="font-bold text-white text-lg">{{ $product['rating'] }}/5.0</p>
                        </div>
                        <p class="text-sm text-slate-400">{{ $product['reviews'] }} verified reviews · {{ $product['bookings'] }} bookings</p>
                    </div>

                    <div class="bg-gradient-to-br from-cyan-500/20 to-blue-500/20 border border-cyan-500/30 rounded-xl p-8">
                        <p class="text-5xl font-black text-cyan-400">KES {{ number_format($product['price'] * (1 - $product['discount']/100)) }}</p>
                        <p class="text-sm text-slate-400 mt-1">per day</p>
                        @if($product['discount'] > 0)
                        <p class="text-sm text-slate-400 line-through mt-2">KES {{ number_format($product['price']) }}</p>
                        @endif
                    </div>

                    <div class="bg-white/5 border border-cyan-500/10 rounded-xl p-6">
                        <h4 class="font-bold text-white mb-4 flex items-center gap-2">
                            <span class="text-cyan-400">✓</span> What's Included
                        </h4>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach($product['features'] as $feature)
                            <div class="flex items-center gap-2 text-slate-300 text-sm">
                                <div class="w-1.5 h-1.5 rounded-full bg-cyan-400"></div>
                                <span>{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                        <button type="submit" class="w-full py-4 bg-gradient-to-r from-cyan-500/50 to-blue-500/50 border border-cyan-400/60 rounded-xl font-bold text-lg hover:from-cyan-500/70 hover:to-blue-500/70 transform hover:scale-105 transition-all shadow-lg shadow-cyan-500/20">
                            Book Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @include('partials.footer')
</body>
</html>
