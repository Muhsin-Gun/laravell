@extends('layouts.app')

@section('content')
<div style="margin-bottom: 40px;">
    <h1 style="color: #00e5ff; font-size: 36px; margin-bottom: 10px;">Browse Our Fleet</h1>
    <p style="color: #999;">{{ $cars->total() }} vehicles available</p>
</div>

<!-- Advanced Filters -->
<div style="background: #1e1e1e; padding: 30px; border-radius: 12px; margin-bottom: 40px; border: 1px solid #333;">
    <form method="GET" action="{{ route('cars.index') }}" id="filterForm">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; margin-bottom: 8px; color: #999; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Search</label>
                <input type="text" name="search" placeholder="Car name or brand..." value="{{ request('search') }}" style="width: 100%; padding: 12px; background: #0b0b0b; border: 1px solid #333; color: #fff; border-radius: 8px;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; color: #999; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Vehicle Type</label>
                <select name="type" style="width: 100%; padding: 12px; background: #0b0b0b; border: 1px solid #333; color: #fff; border-radius: 8px;">
                    <option value="">All Types</option>
                    <option value="SUV" {{ request('type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                    <option value="Sedan" {{ request('type') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                    <option value="Truck" {{ request('type') == 'Truck' ? 'selected' : '' }}>Truck</option>
                    <option value="Coupe" {{ request('type') == 'Coupe' ? 'selected' : '' }}>Coupe</option>
                </select>
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; color: #999; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Max Price/Day</label>
                <select name="price_max" style="width: 100%; padding: 12px; background: #0b0b0b; border: 1px solid #333; color: #fff; border-radius: 8px;">
                    <option value="">Any Price</option>
                    <option value="500" {{ request('price_max') == '500' ? 'selected' : '' }}>Under KES 500</option>
                    <option value="1000" {{ request('price_max') == '1000' ? 'selected' : '' }}>Under KES 1,000</option>
                    <option value="2000" {{ request('price_max') == '2000' ? 'selected' : '' }}>Under KES 2,000</option>
                    <option value="5000" {{ request('price_max') == '5000' ? 'selected' : '' }}>Under KES 5,000</option>
                    <option value="10000" {{ request('price_max') == '10000' ? 'selected' : '' }}>Under KES 10,000</option>
                </select>
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; color: #999; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Sort By</label>
                <select name="sort" style="width: 100%; padding: 12px; background: #0b0b0b; border: 1px solid #333; color: #fff; border-radius: 8px;">
                    <option value="">Recommended</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A-Z</option>
                </select>
            </div>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn" style="padding: 12px 30px;">Apply Filters</button>
            <a href="{{ route('cars.index') }}" class="btn" style="background: #333; padding: 12px 30px;">Clear All</a>
        </div>
    </form>
</div>

<!-- Results -->
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 30px; margin-bottom: 40px;">
    @forelse($cars as $car)
    <div style="background: linear-gradient(135deg, #1e1e1e 0%, #252525 100%); border: 1px solid #333; border-radius: 16px; overflow: hidden; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); position: relative; box-shadow: 0 4px 20px rgba(0,0,0,0.3);" class="car-card">
        <!-- Image Container -->
        <div style="position: relative; overflow: hidden; height: 260px; background: #000;">
            <img src="{{ $car->image_path ? asset('storage/' . $car->image_path) : 'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=600&h=400&fit=crop' }}" alt="{{ $car->name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
            <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 50%);"></div>
            @if($car->available)
            <div style="position: absolute; top: 15px; left: 15px; background: rgba(0,255,158,0.95); backdrop-filter: blur(10px); color: #000; padding: 8px 16px; border-radius: 25px; font-size: 11px; font-weight: 800; letter-spacing: 0.5px; box-shadow: 0 4px 15px rgba(0,255,158,0.4);">✓ AVAILABLE</div>
            @else
            <div style="position: absolute; top: 15px; left: 15px; background: rgba(255,0,85,0.95); backdrop-filter: blur(10px); color: #fff; padding: 8px 16px; border-radius: 25px; font-size: 11px; font-weight: 800; letter-spacing: 0.5px; box-shadow: 0 4px 15px rgba(255,0,85,0.4);">⚠ BOOKED</div>
            @endif
        </div>

        <!-- Content Container -->
        <div style="padding: 25px;">
            <!-- Header -->
            <div style="margin-bottom: 18px;">
                <h3 style="color: #00e5ff; margin: 0 0 8px 0; font-size: 24px; font-weight: 800; letter-spacing: -0.5px;">{{ $car->name }}</h3>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <p style="color: #999; margin: 0; font-size: 14px; font-weight: 500;">{{ $car->brand }}</p>
                    <span style="color: #333;">•</span>
                    <span style="background: rgba(0,229,255,0.15); color: #00e5ff; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; border: 1px solid rgba(0,229,255,0.3);">{{ $car->type }}</span>
                </div>
            </div>

            <!-- Description -->
            <p style="color: #666; font-size: 13px; line-height: 1.6; margin-bottom: 18px;">{{ Str::limit($car->description ?? 'Premium vehicle with modern features and exceptional comfort', 85) }}</p>

            <!-- Features Grid -->
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-bottom: 20px;">
                <div style="background: rgba(0,229,255,0.08); border: 1px solid rgba(0,229,255,0.2); padding: 10px; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 18px;">🚗</span>
                    <div>
                        <div style="color: #666; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Transmission</div>
                        <div style="color: #00e5ff; font-size: 12px; font-weight: 600;">Automatic</div>
                    </div>
                </div>
                <div style="background: rgba(0,229,255,0.08); border: 1px solid rgba(0,229,255,0.2); padding: 10px; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 18px;">❄️</span>
                    <div>
                        <div style="color: #666; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Climate</div>
                        <div style="color: #00e5ff; font-size: 12px; font-weight: 600;">AC</div>
                    </div>
                </div>
                <div style="background: rgba(0,229,255,0.08); border: 1px solid rgba(0,229,255,0.2); padding: 10px; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 18px;">👥</span>
                    <div>
                        <div style="color: #666; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Capacity</div>
                        <div style="color: #00e5ff; font-size: 12px; font-weight: 600;">5 Seats</div>
                    </div>
                </div>
                <div style="background: rgba(0,229,255,0.08); border: 1px solid rgba(0,229,255,0.2); padding: 10px; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 18px;">⛽</span>
                    <div>
                        <div style="color: #666; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Fuel</div>
                        <div style="color: #00e5ff; font-size: 12px; font-weight: 600;">Efficient</div>
                    </div>
                </div>
            </div>

            <!-- Price & CTA -->
            <div style="border-top: 1px solid rgba(0,229,255,0.1); padding-top: 20px; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="color: #666; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Starting from</div>
                    <div style="display: flex; align-items: baseline; gap: 6px;">
                        <span style="color: #00ff9e; font-size: 36px; font-weight: 900; line-height: 1;">KES {{ number_format($car->price_per_day, 0) }}</span>
                        <span style="color: #666; font-size: 13px; font-weight: 500;">/day</span>
                    </div>
                </div>
                <a href="{{ route('cars.show', $car) }}" class="btn" style="padding: 14px 28px; font-size: 14px; font-weight: 700; letter-spacing: 0.5px; box-shadow: 0 4px 15px rgba(0,229,255,0.3);">View Details →</a>
            </div>
        </div>
    </div>
    @empty
    <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px;">
        <div style="font-size: 64px; margin-bottom: 20px;">🚗</div>
        <h3 style="color: #00e5ff; margin-bottom: 10px;">No vehicles found</h3>
        <p style="color: #999; margin-bottom: 20px;">Try adjusting your filters or search criteria</p>
        <a href="{{ route('cars.index') }}" class="btn">Clear Filters</a>
    </div>
    @endforelse
</div>

<!-- Pagination -->
<div style="display: flex; justify-content: center; margin-top: 40px;">
    {{ $cars->appends(request()->query())->links() }}
</div>

<style>
.car-card {
    cursor: pointer;
}
.car-card:hover {
    transform: translateY(-8px);
    border-color: #00e5ff;
    box-shadow: 0 20px 50px rgba(0,229,255,0.25), 0 0 0 1px rgba(0,229,255,0.5);
}
.car-card:hover img {
    transform: scale(1.1);
}
</style>
@endsection
