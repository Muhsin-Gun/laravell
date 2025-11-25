@extends('Admin.layout')

@section('content')
<h1 style="color: #00e5ff; margin-bottom: 30px;">Manage Users</h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Loyalty Points</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <span style="padding: 5px 10px; border-radius: 4px;
                    @if($user->role == 'admin') background: rgba(255,0,85,0.2); color: #ff0055;
                    @elseif($user->role == 'employee') background: rgba(255,215,0,0.2); color: #ffd700;
                    @else background: rgba(0,229,255,0.2); color: #00e5ff;
                    @endif">
                    {{ ucfirst($user->role) }}
                </span>
            </td>
            <td>{{ $user->loyalty_points }}</td>
            <td>
                <a href="{{ route('users.edit', $user) }}" style="color: #00e5ff; margin-right: 10px;">Edit</a>
                @if($user->id !== Auth::id())
                <form method="POST" action="{{ route('users.destroy', $user) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: none; border: none; color: #ff0055; cursor: pointer;" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
