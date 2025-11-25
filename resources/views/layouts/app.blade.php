<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','NEXUS - Premium Car Rentals')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-glass { background: rgba(0,0,0,0.6); backdrop-filter: blur(8px); }
    </style>
</head>
<body class="bg-gradient-to-br from-black via-slate-900 to-black text-white min-h-screen antialiased">
    @include('partials.header')

    <main class="relative z-10">
        <div class="max-w-7xl mx-auto px-4 py-16">
            @yield('content')
        </div>
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
