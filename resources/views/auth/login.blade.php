@extends('layout')

@section('content')
<div style="max-width: 500px; margin: 60px auto; background: #1e1e1e; padding: 40px; border-radius: 12px; border: 1px solid #333;">
    <h1 style="color: #00e5ff; text-align: center; margin-bottom: 30px;">Login</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label style="display: block; margin-bottom: 20px;">
            <span style="display: block; margin-bottom: 8px; color: #999;">Email</span>
            <input type="email" name="email" required autofocus>
        </label>

        <label style="display: block; margin-bottom: 30px;">
            <span style="display: block; margin-bottom: 8px; color: #999;">Password</span>
            <input type="password" name="password" required>
        </label>

        <button type="submit" class="btn" style="width: 100%; font-size: 18px;">Login</button>
    </form>

    <p style="text-align: center; margin-top: 20px; color: #999;">
        Don't have an account? <a href="{{ route('register') }}" style="color: #00e5ff;">Register</a>
    </p>
</div>
@endsection
