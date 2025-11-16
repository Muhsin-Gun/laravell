<header class="fixed top-0 w-full z-50 bg-black/80 backdrop-blur-2xl border-b border-cyan-500/20">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="text-3xl transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-300">🚗</div>
                <div class="flex flex-col">
                    <span class="text-2xl font-black bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-500 bg-clip-text text-transparent">NEXUS</span>
                    <span class="text-xs text-cyan-400 font-bold tracking-wider">PREMIUM CARS</span>
                </div>
            </a>

            <nav class="hidden lg:flex gap-6">
                <a href="{{ route('home') }}" class="text-sm text-slate-300 hover:text-cyan-400 transition">Home</a>
                <a href="{{ route('marketplace') }}" class="text-sm text-slate-300 hover:text-cyan-400 transition">Fleet</a>
                <a href="#" class="text-sm text-slate-300 hover:text-cyan-400 transition">Services</a>
            </nav>

            <div class="flex items-center gap-3">
                <a href="{{ route('checkout') }}" class="relative p-2 hover:bg-white/5 rounded-lg transition group">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-cyan-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @if(session('cart') && count(session('cart')) > 0)
                    <span class="absolute -top-1 -right-1 bg-cyan-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
                        {{ count(session('cart')) }}
                    </span>
                    @endif
                </a>
            </div>
        </div>
    </div>
</header>
