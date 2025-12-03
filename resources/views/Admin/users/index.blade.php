@extends('layouts.dashboard')

@section('content')
<div style="margin-bottom: 30px;">
    <h1 style="color: #00e5ff; margin-bottom: 20px;">Manage Users</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.users.index') }}" style="margin-bottom: 20px;">
        <div style="display: flex; gap: 10px; align-items: center;">
            <input type="text" name="search" placeholder="Search by name, email, or role..." value="{{ request('search') }}"
                   style="flex: 1; padding: 12px; background: #0b0b0b; border: 1px solid #333; color: #fff; border-radius: 8px;">
            <button type="submit" class="btn" style="padding: 12px 30px;">Search</button>
            <a href="{{ route('admin.users.index') }}" class="btn" style="background: #333; padding: 12px 30px;">Clear</a>
        </div>
    </form>
</div>

<table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr style="background: #1a1a1a; border-bottom: 1px solid #333;">
            <th style="padding: 15px; text-align: left; color: #999;">Name</th>
            <th style="padding: 15px; text-align: left; color: #999;">Email</th>
            <th style="padding: 15px; text-align: left; color: #999;">Role</th>
            <th style="padding: 15px; text-align: left; color: #999;">Loyalty Points</th>
            <th style="padding: 15px; text-align: left; color: #999;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
        <tr style="border-bottom: 1px solid #222; hover:background: #0a0a0a;">
            <td style="padding: 15px;">{{ $user->name }}</td>
            <td style="padding: 15px;">{{ $user->email }}</td>
            <td style="padding: 15px;">
                <span style="padding: 5px 10px; border-radius: 4px; display: inline-block;
                    @if($user->role == 'admin') background: rgba(255,0,85,0.2); color: #ff0055;
                    @elseif($user->role == 'employee') background: rgba(255,215,0,0.2); color: #ffd700;
                    @else background: rgba(0,229,255,0.2); color: #00e5ff;
                    @endif">
                    {{ ucfirst($user->role) }}
                </span>
            </td>
            <td style="padding: 15px;">{{ $user->loyalty_points }}</td>
            <td style="padding: 15px; display: flex; gap: 10px;">
                <a href="{{ route('admin.users.edit', $user) }}" style="color: #00e5ff; text-decoration: none;">Edit</a>
                @if($user->id !== Auth::id())
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: none; border: none; color: #ff0055; cursor: pointer; text-decoration: underline;" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="padding: 30px; text-align: center; color: #666;">No users found matching your search.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination -->
@if($users->hasPages())
<div style="margin-top: 30px; display: flex; justify-content: center;">
    {{ $users->appends(request()->query())->links() }}
</div>
@endif
@endsection
