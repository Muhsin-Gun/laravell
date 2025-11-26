@extends('layouts.app')

@section('title', $car->name . ' - NEXUS')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('cars.index') }}" class="text-cyan-400 hover:text-cyan-300 text-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Fleet
        </a>
    </div>

    <div class="grid md:grid-cols-2 gap-10">
        <div>
            <div class="relative rounded-2xl overflow-hidden border border-cyan-500/20">
                <img src="{{ $car->image_path ? asset('storage/' . $car->image_path) : 'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=800' }}" 
                     alt="{{ $car->name }}" 
                     class="w-full h-96 object-cover">
                @if($car->available)
                    <div class="absolute top-4 left-4 px-4 py-2 bg-green-500/90 backdrop-blur rounded-full text-sm font-bold text-white">Available</div>
                @else
                    <div class="absolute top-4 left-4 px-4 py-2 bg-red-500/90 backdrop-blur rounded-full text-sm font-bold text-white">Not Available</div>
                @endif
            </div>
            
            @if($car->features)
                <div class="mt-6 p-6 bg-white/5 border border-cyan-500/10 rounded-2xl">
                    <h3 class="text-lg font-bold mb-4">Features</h3>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach(json_decode($car->features, true) ?? [] as $feature)
                            <div class="flex items-center gap-2 text-sm text-slate-300">
                                <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ $feature }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($car->reviews && $car->reviews->count() > 0)
                <div class="mt-6 p-6 bg-white/5 border border-cyan-500/10 rounded-2xl">
                    <h3 class="text-lg font-bold mb-4">Customer Reviews</h3>
                    <div class="space-y-4">
                        @foreach($car->reviews->take(3) as $review)
                            <div class="border-b border-slate-700 pb-4 last:border-0 last:pb-0">
                                <div class="flex items-center gap-1 mb-2">
                                    @for($i = 0; $i < $review->rating; $i++)
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <p class="text-sm text-slate-300 italic">"{{ $review->comment }}"</p>
                                <p class="text-xs text-slate-500 mt-1">- {{ $review->user->name ?? 'Customer' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        
        <div>
            <div class="mb-6">
                <span class="text-cyan-400 text-sm font-medium">{{ $car->brand }} • {{ $car->type }}</span>
                <h1 class="text-4xl font-extrabold text-white mt-2">{{ $car->name }}</h1>
            </div>
            
            <div class="flex items-baseline gap-2 mb-6">
                <span class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-400">${{ number_format($car->price_per_day, 0) }}</span>
                <span class="text-slate-400 text-lg">/ day</span>
            </div>
            
            <p class="text-slate-300 leading-relaxed mb-8">{{ $car->description ?? 'Experience luxury and performance with this premium vehicle. Perfect for business trips, special occasions, or when you simply want to travel in style.' }}</p>
            
            @auth
                @if($car->available)
                    <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-cyan-500/20 rounded-2xl p-6">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                            <span class="text-2xl">🚗</span> Book This Vehicle
                        </h3>
                        
                        <form method="POST" action="{{ route('bookings.store', $car) }}" id="bookingForm">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm text-slate-400 mb-2">Pick-up Date</label>
                                    <input type="date" 
                                           name="start_date" 
                                           id="start_date"
                                           required 
                                           min="{{ date('Y-m-d') }}" 
                                           class="w-full px-4 py-3 bg-black/50 border border-slate-600 rounded-xl text-white focus:border-cyan-500 focus:outline-none">
                                </div>
                                
                                <div>
                                    <label class="block text-sm text-slate-400 mb-2">Return Date</label>
                                    <input type="date" 
                                           name="end_date" 
                                           id="end_date"
                                           required 
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                                           class="w-full px-4 py-3 bg-black/50 border border-slate-600 rounded-xl text-white focus:border-cyan-500 focus:outline-none">
                                </div>
                                
                                <div class="pt-4 border-t border-slate-700">
                                    <div class="flex justify-between mb-2">
                                        <span class="text-slate-400">Daily Rate</span>
                                        <span class="text-white">${{ number_format($car->price_per_day, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between mb-2" id="daysRow" style="display: none;">
                                        <span class="text-slate-400">Number of Days</span>
                                        <span class="text-white" id="numDays">0</span>
                                    </div>
                                    <div class="flex justify-between text-lg font-bold pt-2 border-t border-slate-700" id="totalRow" style="display: none;">
                                        <span class="text-white">Estimated Total</span>
                                        <span class="text-green-400" id="totalPrice">$0</span>
                                    </div>
                                </div>
                                
                                <button type="submit" 
                                        class="w-full py-4 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl font-bold text-lg hover:scale-[1.02] transform transition shadow-lg shadow-cyan-500/25">
                                    Proceed to Checkout
                                </button>
                            </div>
                        </form>
                        
                        <p class="text-xs text-slate-500 text-center mt-4">
                            By booking, you agree to our rental terms and conditions
                        </p>
                    </div>
                @else
                    <div class="bg-red-500/10 border border-red-500/30 rounded-2xl p-6 text-center">
                        <h3 class="text-xl font-bold text-red-400 mb-2">Currently Unavailable</h3>
                        <p class="text-slate-400">This vehicle is currently booked. Please check back later or browse other vehicles.</p>
                        <a href="{{ route('cars.index') }}" class="inline-block mt-4 px-6 py-3 bg-red-500/20 text-red-400 rounded-xl hover:bg-red-500/30 transition">
                            Browse Other Vehicles
                        </a>
                    </div>
                @endif
            @else
                <div class="bg-slate-800/50 border border-cyan-500/20 rounded-2xl p-8 text-center">
                    <div class="text-4xl mb-4">🔐</div>
                    <h3 class="text-xl font-bold text-white mb-2">Login Required</h3>
                    <p class="text-slate-400 mb-6">Please login or create an account to book this vehicle</p>
                    <div class="flex gap-4 justify-center">
                        <a href="{{ route('login') }}" class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl font-bold hover:scale-105 transition">Login</a>
                        <a href="{{ route('register') }}" class="px-6 py-3 border border-cyan-500/30 text-cyan-400 rounded-xl hover:bg-cyan-500/10 transition">Register</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    const daysRow = document.getElementById('daysRow');
    const totalRow = document.getElementById('totalRow');
    const numDays = document.getElementById('numDays');
    const totalPrice = document.getElementById('totalPrice');
    const pricePerDay = {{ $car->price_per_day }};
    
    function calculateTotal() {
        if (startDate.value && endDate.value) {
            const start = new Date(startDate.value);
            const end = new Date(endDate.value);
            const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
            
            if (days > 0) {
                daysRow.style.display = 'flex';
                totalRow.style.display = 'flex';
                numDays.textContent = days + ' day' + (days > 1 ? 's' : '');
                totalPrice.textContent = '$' + (days * pricePerDay).toLocaleString('en-US', {minimumFractionDigits: 2});
            }
        }
    }
    
    startDate.addEventListener('change', function() {
        const nextDay = new Date(this.value);
        nextDay.setDate(nextDay.getDate() + 1);
        endDate.min = nextDay.toISOString().split('T')[0];
        calculateTotal();
    });
    
    endDate.addEventListener('change', calculateTotal);
});
</script>
@endpush
@endsection
