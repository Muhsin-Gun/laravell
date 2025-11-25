@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 60px auto;">
    <h1 style="color: #00e5ff; margin-bottom: 30px;">Your Profile</h1>

    <div style="background: #1e1e1e; padding: 40px; border-radius: 12px; border: 1px solid #333;">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <label style="display: block; margin-bottom: 20px;">
                <span style="display: block; margin-bottom: 8px; color: #999;">Name</span>
                <input type="text" name="name" value="{{ $user->name }}" required>
            </label>

            <label style="display: block; margin-bottom: 20px;">
                <span style="display: block; margin-bottom: 8px; color: #999;">Email</span>
                <input type="email" name="email" value="{{ $user->email }}" required>
            </label>

            <label style="display: block; margin-bottom: 30px;">
                <span style="display: block; margin-bottom: 8px; color: #999;">Avatar</span>
                <input type="file" name="avatar" accept="image/*">
            </label>

            <button type="submit" class="btn" style="width: 100%; font-size: 18px;">Update Profile</button>
        </form>
    </div>
</div>
@endsection
