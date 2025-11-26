<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - NEXUS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar-link { transition: all 0.2s ease; }
        .sidebar-link:hover { background: rgba(0, 229, 255, 0.1); }
        .sidebar-link.active { background: linear-gradient(90deg, rgba(0,229,255,0.2), transparent); border-left: 3px solid #00e5ff; }
    </style>
</head>
<body class="bg-slate-900 text-white min-h-screen">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-800/50 border-r border-slate-700 flex flex-col">
            <div class="p-6 border-b border-slate-700">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <span class="text-3xl">🚗</span>
                    <div>
                        <div class="text-xl font-bold bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">NEXUS</div>
                        <div class="text-xs text-cyan-400">@yield('role-badge', 'Dashboard')</div>
                    </div>
                </a>
            </div>
            
            <nav class="flex-1 p-4 space-y-1">
                @yield('sidebar-menu')
            </nav>
            
            <div class="p-4 border-t border-slate-700">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center font-bold">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div>
                        <div class="font-medium text-sm">{{ Auth::user()->name ?? 'User' }}</div>
                        <div class="text-xs text-slate-400">{{ Auth::user()->email ?? '' }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-red-500/10 rounded-lg transition">
                        Logout
                    </button>
                </form>
            </div>
        </aside>
        
        <main class="flex-1 flex flex-col">
            <header class="bg-slate-800/30 border-b border-slate-700 px-6 py-4">
                <h1 class="text-xl font-bold">@yield('page-title', 'Dashboard')</h1>
            </header>
            
            <div class="flex-1 p-6 overflow-auto">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400">
                        {{ session('error') }}
                    </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
