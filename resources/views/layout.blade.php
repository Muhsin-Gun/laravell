<!DOCTYPE html>
<html>
<head>
    <title>Car Rental Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #0b0b0b; color: #FFFFFF; font-family: 'Inter', Arial, sans-serif; margin:0; padding:0;}
        a { color: #00e5ff; text-decoration: none;}
        a:hover { color: #00ff9e; }
        .navbar { background-color: #000; padding: 20px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #333; }
        .navbar a { color: #FFF; margin: 0 15px; text-decoration: none; transition: color 0.3s; }
        .navbar a:hover { color: #00e5ff; }
        .container { padding: 40px 20px; max-width: 1200px; margin: 0 auto; }
        .car-card { background: #1e1e1e; border: 1px solid #333; padding:0; transition: all 0.3s; border-radius: 12px; overflow: hidden; }
        .car-card img { width:100%; height:220px; object-fit:cover; }
        .car-card:hover { transform: translateY(-4px); border-color: #00e5ff; box-shadow: 0 10px 30px rgba(0,229,255,0.1); }
        .btn { background: linear-gradient(90deg, #00e5ff, #00ff9e); color: #000; padding: 10px 20px; border: none; cursor: pointer; transition: all 0.3s ease; margin-top:10px; display:inline-block; border-radius: 6px; font-weight: 600; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,229,255,0.3); }
        .clearfix::after { content: ""; clear: both; display: table; }
        table { width: 100%; border-collapse: collapse; margin:20px 0; }
        table, th, td { border: 1px solid #333; }
        th, td { padding: 12px; text-align: left; }
        th { background-color: #1e1e1e; color: #00e5ff; }
        td { background-color: #0b0b0b; }
        input, select, textarea { background: #1e1e1e; border: 1px solid #333; color: #fff; padding: 10px; border-radius: 4px; width: 100%; margin: 5px 0; }
        input:focus, select:focus, textarea:focus { outline: none; border-color: #00e5ff; }
        .alert { padding: 15px; margin: 20px 0; border-radius: 6px; }
        .alert-success { background: rgba(0,255,158,0.1); border: 1px solid #00ff9e; color: #00ff9e; }
        .alert-error { background: rgba(255,0,85,0.1); border: 1px solid #ff0055; color: #ff0055; }
    </style>
</head>
<body>
    <div class="navbar">
        <div>
            <a href="{{ route('home') }}" style="font-size: 24px; font-weight: bold;">🚗 FUTURECAR</a>
        </div>
        <div>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('cars.index') }}">Cars</a>
            <a href="{{ route('help') }}">Help</a>
            @if(Auth::check())
                <a href="{{ route('dashboard.client') }}">Dashboard</a>
                <a href="{{ route('profile.show') }}">Profile</a>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard.admin') }}">Admin</a>
                @endif
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endif
        </div>
    </div>
    <div class="container clearfix">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        @yield('content')
    </div>
    <footer style="background: #000; padding: 30px; text-align: center; border-top: 1px solid #333; margin-top: 60px;">
        <p style="color: #666;">© {{ date('Y') }} FutureCar Rental. Made with ❤️ for Kenya's transportation revolution.</p>
    </footer>
</body>
</html>
