@extends('layout')

@section('content')
<div style="margin-bottom: 40px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="color: #00e5ff; font-size: 36px; margin: 0 0 10px 0;">Welcome back, {{ Auth::user()->name }}!</h1>
            <p style="color: #999;">Manage your bookings and profile</p>
        </div>
        <div style="display: flex; gap: 15px; align-items: center;">
            <div style="text-align: right;">
                <div style="color: #999; font-size: 12px;">Loyalty Points</div>
                <div style="color: #00ff9e; font-size: 24px; font-weight: bold;">{{ Auth::user()->loyalty_points }}</div>
            </div>
            <img src="{{ Auth::user()->avatar_path ? asset('storage/' . Auth::user()->avatar_path) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=00e5ff&color=000' }}" style="width: 60px; height: 60px; border-radius: 50%; border: 2px solid #00e5ff;">
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px;">
    <div style="background: linear-gradient(135deg, rgba(0,229,255,0.1), rgba(0,229,255,0.05)); padding: 25px; border-radius: 12px; border: 1px solid rgba(0,229,255,0.2);">
        <div style="color: #999; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Total Bookings</div>
        <div style="color: #00e5ff; font-size: 36px; font-weight: bold;">{{ $bookings->count() }}</div>
    </div>
    <div style="background: linear-gradient(135deg, rgba(0,255,158,0.1), rgba(0,255,158,0.05)); padding: 25px; border-radius: 12px; border: 1px solid rgba(0,255,158,0.2);">
        <div style="color: #999; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Active Bookings</div>
        <div style="color: #00ff9e; font-size: 36px; font-weight: bold;">{{ $bookings->whereIn('status', ['pending', 'approved'])->count() }}</div>
    </div>
    <div style="background: linear-gradient(135deg, rgba(255,215,0,0.1), rgba(255,215,0,0.05)); padding: 25px; border-radius: 12px; border: 1px solid rgba(255,215,0,0.2);">
        <div style="color: #999; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Completed Trips</div>
        <div style="color: #ffd700; font-size: 36px; font-weight: bold;">{{ $bookings->where('status', 'completed')->count() }}</div>
    </div>
    <div style="background: linear-gradient(135deg, rgba(255,0,85,0.1), rgba(255,0,85,0.05)); padding: 25px; border-radius: 12px; border: 1px solid rgba(255,0,85,0.2);">
        <div style="color: #999; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Total Spent</div>
        <div style="color: #ff0055; font-size: 36px; font-weight: bold;">${{ number_format($bookings->where('status', 'completed')->sum('total_price'), 0) }}</div>
    </div>
</div>

<!-- Quick Actions -->
<div style="background: #1e1e1e; padding: 30px; border-radius: 12px; border: 1px solid #333; margin-bottom: 40px;">
    <h2 style="color: #00e5ff; margin-bottom: 20px; font-size: 20px;">Quick Actions</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
        <a href="{{ route('cars.index') }}" style="background: rgba(0,229,255,0.1); padding: 20px; border-radius: 8px; border: 1px solid rgba(0,229,255,0.2); text-align: center; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='rgba(0,229,255,0.2)'" onmouseout="this.style.background='rgba(0,229,255,0.1)'">
            <div style="font-size: 32px; margin-bottom: 10px;">🚗</div>
            <div style="color: #00e5ff; font-weight: 600;">Browse Cars</div>
        </a>
        <a href="{{ route('bookings.index') }}" style="background: rgba(0,255,158,0.1); padding: 20px; border-radius: 8px; border: 1px solid rgba(0,255,158,0.2); text-align: center; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='rgba(0,255,158,0.2)'" onmouseout="this.style.background='rgba(0,255,158,0.1)'">
            <div style="font-size: 32px; margin-bottom: 10px;">📋</div>
            <div style="color: #00ff9e; font-weight: 600;">My Bookings</div>
        </a>
        <a href="{{ route('profile.show') }}" style="background: rgba(255,215,0,0.1); padding: 20px; border-radius: 8px; border: 1px solid rgba(255,215,0,0.2); text-align: center; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='rgba(255,215,0,0.2)'" onmouseout="this.style.background='rgba(255,215,0,0.1)'">
            <div style="font-size: 32px; margin-bottom: 10px;">👤</div>
            <div style="color: #ffd700; font-weight: 600;">My Profile</div>
        </a>
        <a href="{{ route('help') }}" style="background: rgba(255,0,85,0.1); padding: 20px; border-radius: 8px; border: 1px solid rgba(255,0,85,0.2); text-align: center; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='rgba(255,0,85,0.2)'" onmouseout="this.style.background='rgba(255,0,85,0.1)'">
            <div style="font-size: 32px; margin-bottom: 10px;">💬</div>
            <div style="color: #ff0055; font-weight: 600;">Get Help</div>
        </a>
    </div>
</div>

<!-- Recent Bookings -->
<div style="background: #1e1e1e; padding: 30px; border-radius: 12px; border: 1px solid #333;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h2 style="color: #00e5ff; margin: 0; font-size: 24px;">Recent Bookings</h2>
        <a href="{{ route('bookings.index') }}" style="color: #00ff9e; text-decoration: none; font-weight: 600;">View All →</a>
    </div>

    @if($bookings->count() > 0)
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
            <thead>
                <tr style="background: #0b0b0b;">
                    <th style="padding: 15px; text-align: left; color: #00e5ff; font-weight: 600; border-bottom: 2px solid #333;">Car</th>
                    <th style="padding: 15px; text-align: left; color: #00e5ff; font-weight: 600; border-bottom: 2px solid #333;">Dates</th>
                    <th style="padding: 15px; text-align: left; color: #00e5ff; font-weight: 600; border-bottom: 2px solid #333;">Status</th>
                    <th style="padding: 15px; text-align: left; color: #00e5ff; font-weight: 600; border-bottom: 2px solid #333;">Total</th>
                    <th style="padding: 15px; text-align: left; color: #00e5ff; font-weight: 600; border-bottom: 2px solid #333;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings->take(5) as $booking)
                <tr style="border-bottom: 1px solid #333;">
                    <td style="padding: 15px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <img src="https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=100" style="width: 60px; height: 40px; object-fit: cover; border-radius: 6px;">
                            <div>
                                <div style="color: #fff; font-weight: 600;">{{ $booking->car->name }}</div>
                                <div style="color: #666; font-size: 12px;">{{ $booking->car->brand }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 15px; color: #ccc;">
                        <div style="font-size: 13px;">{{ $booking->start_date->format('M d') }} - {{ $booking->end_date->format('M d, Y') }}</div>
                        <div style="color: #666; font-size: 11px;">{{ $booking->start_date->diffInDays($booking->end_date) + 1 }} days</div>
                    </td>
                    <td style="padding: 15px;">
                        @if($booking->status == 'pending')
                        <span style="background: rgba(255,215,0,0.2); color: #ffd700; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;">⏳ PENDING</span>
                        @elseif($booking->status == 'approved')
                        <span style="background: rgba(0,255,158,0.2); color: #00ff9e; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;">✓ APPROVED</span>
                        @elseif($booking->status == 'completed')
                        <span style="background: rgba(0,229,255,0.2); color: #00e5ff; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;">✓ COMPLETED</span>
                        @else
                        <span style="background: rgba(255,0,85,0.2); color: #ff0055; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;">✗ CANCELLED</span>
                        @endif
                    </td>
                    <td style="padding: 15px; color: #00ff9e; font-weight: 600; font-size: 16px;">${{ number_format($booking->total_price, 0) }}</td>
                    <td style="padding: 15px;">
                        <a href="#" style="color: #00e5ff; text-decoration: none; font-size: 13px;">View Details →</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div style="text-align: center; padding: 60px 20px;">
        <div style="font-size: 64px; margin-bottom: 20px;">🚗</div>
        <h3 style="color: #00e5ff; margin-bottom: 10px;">No bookings yet</h3>
        <p style="color: #999; margin-bottom: 25px;">Start exploring our premium fleet</p>
        <a href="{{ route('cars.index') }}" class="btn" style="padding: 12px 30px;">Browse Cars</a>
    </div>
    @endif
</div>
@endsection
