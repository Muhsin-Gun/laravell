<header class="fixed top-0 left-0 right-0 z-50">
    <div class="bg-glass border-b border-cyan-500/10">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <a href="{{ Route::has('home') ? route('home') : url('/') }}" class="flex items-center">
                    <span class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-500">NEXUS</span>
                </a>

                <nav class="hidden md:flex items-center justify-center flex-1 mx-8">
                    <div class="flex items-center gap-8">
                        <a href="{{ Route::has('home') ? route('home') : url('/') }}" class="text-sm font-medium text-slate-200 hover:text-cyan-400 transition">Home</a>
                        <a href="{{ Route::has('marketplace') ? route('marketplace') : route('cars.index') }}" class="text-sm font-medium text-slate-200 hover:text-cyan-400 transition">Fleet</a>
                        
                        <div class="relative group">
                            <button class="text-sm font-medium text-slate-200 hover:text-cyan-400 transition flex items-center gap-1">
                                Services
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div class="absolute top-full left-1/2 -translate-x-1/2 pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                <div class="bg-slate-900/95 backdrop-blur-xl border border-cyan-500/20 rounded-xl p-4 min-w-[220px] shadow-xl shadow-cyan-500/10">
                                    <a href="#services" class="flex items-center gap-3 p-3 rounded-lg hover:bg-cyan-500/10 transition">
                                        <div class="w-10 h-10 rounded-lg bg-cyan-500/20 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-white">Car Rentals</p>
                                            <p class="text-xs text-slate-400">Daily & weekly rentals</p>
                                        </div>
                                    </a>
                                    <a href="#services" class="flex items-center gap-3 p-3 rounded-lg hover:bg-cyan-500/10 transition">
                                        <div class="w-10 h-10 rounded-lg bg-purple-500/20 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-white">Airport Transfers</p>
                                            <p class="text-xs text-slate-400">Pickup & drop-off</p>
                                        </div>
                                    </a>
                                    <a href="#services" class="flex items-center gap-3 p-3 rounded-lg hover:bg-cyan-500/10 transition">
                                        <div class="w-10 h-10 rounded-lg bg-blue-500/20 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-white">Chauffeur Service</p>
                                            <p class="text-xs text-slate-400">Professional drivers</p>
                                        </div>
                                    </a>
                                    <a href="#services" class="flex items-center gap-3 p-3 rounded-lg hover:bg-cyan-500/10 transition">
                                        <div class="w-10 h-10 rounded-lg bg-green-500/20 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-white">Safari Tours</p>
                                            <p class="text-xs text-slate-400">Guided adventures</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ route('help') }}" class="text-sm font-medium text-slate-200 hover:text-cyan-400 transition">Help</a>
                    </div>
                </nav>

                <div class="flex items-center gap-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-200 hover:text-white transition">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-lg text-sm font-bold hover:scale-105 transition">Sign Up</a>
                    @else
                        <div class="relative group">
                            <button class="flex items-center gap-2 text-sm text-slate-200 hover:text-cyan-400 transition">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center font-bold text-xs">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                            </button>
                            <div class="absolute top-full right-0 pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                <div class="bg-slate-900/95 backdrop-blur-xl border border-cyan-500/20 rounded-xl p-2 min-w-[180px] shadow-xl">
                                    <a href="{{ route('dashboard.client') }}" class="block px-4 py-2 text-sm text-slate-200 hover:bg-cyan-500/10 rounded-lg transition">Dashboard</a>
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-slate-200 hover:bg-cyan-500/10 rounded-lg transition">Admin Panel</a>
                                    @elseif(auth()->user()->role === 'employee')
                                        <a href="{{ route('employee.dashboard') }}" class="block px-4 py-2 text-sm text-slate-200 hover:bg-cyan-500/10 rounded-lg transition">Employee Panel</a>
                                    @endif
                                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-slate-200 hover:bg-cyan-500/10 rounded-lg transition">Profile</a>
                                    <hr class="my-2 border-cyan-500/10">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-red-500/10 rounded-lg transition">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>

                <div class="md:hidden ml-4">
                    <button id="mobile-menu-button" aria-expanded="false" class="p-2 rounded-md text-slate-200 hover:bg-white/5">
                        <svg id="mobile-menu-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg id="mobile-menu-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            <div id="mobile-menu" class="md:hidden hidden border-t border-cyan-500/5 mt-3 pt-3">
                <div class="space-y-2">
                    <a href="{{ Route::has('home') ? route('home') : url('/') }}" class="block px-4 py-2 text-sm text-slate-200 hover:bg-cyan-500/10 rounded-lg">Home</a>
                    <a href="{{ Route::has('marketplace') ? route('marketplace') : route('cars.index') }}" class="block px-4 py-2 text-sm text-slate-200 hover:bg-cyan-500/10 rounded-lg">Fleet</a>
                    <div class="px-4 py-2">
                        <p class="text-xs text-slate-500 uppercase tracking-wider mb-2">Services</p>
                        <a href="#services" class="block py-2 text-sm text-slate-200 hover:text-cyan-400">Car Rentals</a>
                        <a href="#services" class="block py-2 text-sm text-slate-200 hover:text-cyan-400">Airport Transfers</a>
                        <a href="#services" class="block py-2 text-sm text-slate-200 hover:text-cyan-400">Chauffeur Service</a>
                        <a href="#services" class="block py-2 text-sm text-slate-200 hover:text-cyan-400">Safari Tours</a>
                    </div>
                    <a href="{{ route('help') }}" class="block px-4 py-2 text-sm text-slate-200 hover:bg-cyan-500/10 rounded-lg">Help</a>
                    @guest
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-slate-200 hover:bg-cyan-500/10 rounded-lg">Login</a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-cyan-400 hover:bg-cyan-500/10 rounded-lg">Sign Up</a>
                    @else
                        <a href="{{ route('dashboard.client') }}" class="block px-4 py-2 text-sm text-slate-200 hover:bg-cyan-500/10 rounded-lg">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-red-500/10 rounded-lg">Logout</button>
                        </form>
                    @endguest
                </div>
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
                menu.classList.toggle('hidden');
                openIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });
        })();
    </script>
    @endpush
</header>
