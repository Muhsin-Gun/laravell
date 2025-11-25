<header class="fixed top-0 left-0 right-0 z-50">
    <div class="bg-glass border-b border-cyan-500/10">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between gap-4">
            <a href="{{ Route::has('home') ? route('home') : url('/') }}" class="flex items-center gap-3">
                <div class="text-3xl transform transition group-hover:scale-110">🚗</div>
                <div class="leading-tight">
                    <div class="text-lg font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-blue-400">NEXUS</div>
                    <div class="text-xs text-cyan-300">Premium Cars</div>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-6 ml-6">
                <a href="{{ Route::has('home') ? route('home') : url('/') }}" class="text-sm text-slate-200 hover:text-cyan-400 transition">Home</a>
                <a href="{{ Route::has('marketplace') ? route('marketplace') : route('cars.index') }}" class="text-sm text-slate-200 hover:text-cyan-400 transition">Fleet</a>
                <a href="#" class="text-sm text-slate-200 hover:text-cyan-400 transition">Services</a>
            </nav>

            <div class="flex items-center gap-3 ml-auto">
                @guest
                    <a href="{{ route('login') }}" class="text-sm text-slate-200 hover:text-white">Login</a>
                @else
                    <a href="{{ route('dashboard.client') }}" class="text-sm text-slate-200 hover:text-cyan-400">{{ auth()->user()->name }}</a>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('dashboard.admin') }}" class="text-sm text-slate-200 hover:text-cyan-400 ml-3">Admin</a>
                    @elseif(auth()->user()->role === 'employee')
                        <a href="{{ route('employee.dashboard') }}" class="text-sm text-slate-200 hover:text-cyan-400 ml-3">Employee</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-slate-200 hover:text-red-400 ml-3">Logout</button>
                    </form>
                @endguest

                @php
                    $checkoutUrl = '#';
                    if (Route::has('checkout')) {
                        $routeObj = Illuminate\Support\Facades\Route::getRoutes()->getByName('checkout');
                        if ($routeObj && count($routeObj->parameterNames()) === 0) {
                            try { $checkoutUrl = route('checkout'); } catch (\Throwable $e) { $checkoutUrl = '#'; }
                        }
                    }
                @endphp
                <a href="{{ $checkoutUrl }}" class="relative p-2 rounded-lg hover:bg-white/5 transition">
                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4z" />
                    </svg>
                    @if(session('cart') && is_array(session('cart')) && count(session('cart')) > 0)
                        <span class="absolute -top-1 -right-1 bg-cyan-500 text-black text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">{{ count(session('cart')) }}</span>
                    @endif
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden ml-4">
                <button id="mobile-menu-button" aria-expanded="false" class="p-2 rounded-md text-slate-200 hover:bg-white/5">
                    <svg id="mobile-menu-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg id="mobile-menu-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden hidden border-t border-cyan-500/5">
                <div class="px-4 py-4 space-y-2">
                <a href="{{ Route::has('home') ? route('home') : url('/') }}" class="block text-sm text-slate-200">Home</a>
                <a href="{{ Route::has('marketplace') ? route('marketplace') : route('cars.index') }}" class="block text-sm text-slate-200">Fleet</a>
                <a href="#" class="block text-sm text-slate-200">Services</a>
                @guest
                    <a href="{{ route('login') }}" class="block text-sm text-slate-200">Login</a>
                @else
                    <a href="{{ route('dashboard.client') }}" class="block text-sm text-slate-200">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left text-sm text-slate-200">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        (function(){
            const btn = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');
            const openIcon = document.getElementById('mobile-menu-open');
            const closeIcon = document.getElementById('mobile-menu-close');
            if(!btn) return;
            btn.addEventListener('click', () => {
                const open = menu.classList.toggle('hidden');
                openIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });
        })();
    </script>
    @endpush
