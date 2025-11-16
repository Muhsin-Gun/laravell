<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleet - NEXUS Premium Cars</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">
    <div class="fixed inset-0 bg-gradient-to-br from-black via-slate-900 to-black"></div>

    @include('partials.header')

    <main class="relative z-10 pt-32 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-20">
            <div class="mb-12">
                <h1 class="text-5xl font-black mb-4">
                    <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Our Fleet</span>
                </h1>
                <p class="text-slate-400 text-lg">Browse our premium collection of luxury vehicles</p>
            </div>

            @if(session('success'))
            <div class="mb-6 bg-green-500/20 border border-green-500/50 text-green-400 px-6 py-3 rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            <form method="GET" action="{{ route('marketplace') }}" class="flex flex-wrap gap-4 mb-12 p-6 bg-white/5 border border-cyan-500/20 rounded-2xl backdrop-blur-xl">
                <div class="flex-1 min-w-[200px]">
                    <input type="text" name="search" placeholder="Search vehicles..." value="{{ request('search') }}"
                        class="w-full px-4 py-2.5 bg-white/10 border border-cyan-500/30 rounded-lg text-white text-sm placeholder-slate-500 focus:border-cyan-400 focus:bg-white/20 outline-none transition-all">
                </div>
                <select name="category" class="px-4 py-2.5 bg-white/10 border border-cyan-500/30 rounded-lg text-white text-sm focus:border-cyan-400 outline-none">
                    <option value="all">All Categories</option>
                    <option value="Luxury" {{ request('category') == 'Luxury' ? 'selected' : '' }}>Luxury</option>
                    <option value="SUV" {{ request('category') == 'SUV' ? 'selected' : '' }}>SUV</option>
                    <option value="Electric" {{ request('category') == 'Electric' ? 'selected' : '' }}>Electric</option>
                    <option value="Sport" {{ request('category') == 'Sport' ? 'selected' : '' }}>Sport</option>
                    <option value="Ultra Luxury" {{ request('category') == 'Ultra Luxury' ? 'selected' : '' }}>Ultra Luxury</option>
                </select>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-cyan-500/50 to-blue-500/50 border border-cyan-400/60 rounded-lg font-bold hover:from-cyan-500/70 hover:to-blue-500/70 transition">
                    Search
                </button>
            </form>

            <div class="mb-8">
                <p class="text-slate-400">Showing <span class="text-cyan-400 font-bold">{{ count($products) }}</span> vehicles</p>
            </div>

            <div class="grid md:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div class="bg-white/5 border border-cyan-500/20 rounded-xl overflow-hidden hover:border-cyan-500/50 hover:shadow-xl hover:shadow-cyan-500/20 transform hover:-translate-y-1 transition-all duration-300">
                    <div class="relative h-48 bg-gradient-to-br from-slate-800 to-black flex items-center justify-center text-6xl">
                        {{ $product['image'] }}
                        @if($product['discount'] > 0)
                        <div class="absolute top-2 right-2 px-2 py-1 bg-red-500/30 backdrop-blur-xl rounded text-xs font-bold text-red-300">
                            -{{ $product['discount'] }}%
                        </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <p class="text-cyan-400 text-xs font-bold uppercase mb-1">{{ $product['category'] }}</p>
                        <h3 class="font-bold text-white text-sm mb-2">{{ $product['name'] }}</h3>
                        <div class="flex items-center gap-1 mb-3">
                            <span class="text-yellow-400 text-xs">★</span>
                            <span class="text-xs text-yellow-400 font-bold">{{ $product['rating'] }}</span>
                            <span class="text-xs text-slate-500">({{ $product['reviews'] }})</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-black text-cyan-400 text-sm">KES {{ number_format($product['price'] * (1 - $product['discount']/100)) }}</p>
                                <p class="text-xs text-slate-500">/day</p>
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                <button type="submit" class="px-3 py-1 bg-cyan-500/40 rounded text-xs font-bold hover:bg-cyan-500/60 transform hover:scale-105 transition-all">
                                    Book
                                </button>
                            </form>
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
