@extends('layouts.dashboard')

@section('content')
<div style="max-width: 600px; margin: 60px auto;">
    <h1 style="color: #00e5ff; margin-bottom: 30px;">Edit User</h1>

    <div style="background: #1e1e1e; padding: 40px; border-radius: 12px; border: 1px solid #333;">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <label style="display: block; margin-bottom: 20px;">
                <span style="display: block; margin-bottom: 8px; color: #999;">Name</span>
                <input type="text" value="{{ $user->name }}" disabled>
            </label>

            <label style="display: block; margin-bottom: 20px;">
                <span style="display: block; margin-bottom: 8px; color: #999;">Email</span>
                <input type="text" value="{{ $user->email }}" disabled>
            </label>

            <label style="display: block; margin-bottom: 30px;">
                <span style="display: block; margin-bottom: 8px; color: #999;">Role</span>
                <select name="role" required>
                    <option value="client" {{ $user->role == 'client' ? 'selected' : '' }}>Client</option>
                    <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </label>

            <button type="submit" class="btn" style="width: 100%; font-size: 18px;">Update User</button>
        </form>
    </div>
</div>
@endsection
