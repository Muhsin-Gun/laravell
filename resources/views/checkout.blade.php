@extends('layouts.app')

@section('title', 'Checkout - NEXUS')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">Complete Your Booking</h1>
        <p class="text-slate-400 mt-2">Review your booking details and make payment</p>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        <div class="md:col-span-2">
            <div class="bg-white/5 border border-cyan-500/10 rounded-2xl p-6 mb-6">
                <h2 class="text-lg font-bold text-white mb-4">Booking Summary</h2>
                
                <div class="flex items-start gap-4 pb-4 border-b border-slate-700">
                    <div class="w-24 h-24 rounded-lg overflow-hidden bg-slate-800">
                        @if($booking->car && $booking->car->image_path)
                            <img src="{{ asset('storage/' . $booking->car->image_path) }}" alt="{{ $booking->car->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-4xl">🚗</div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-white">{{ $booking->car->name ?? 'Vehicle' }}</h3>
                        <p class="text-sm text-slate-400">{{ $booking->car->brand ?? '' }} • {{ $booking->car->type ?? '' }}</p>
                        <p class="text-cyan-400 font-bold mt-2">KES {{ number_format($booking->car->price_per_day ?? 0, 0) }} / day</p>
                    </div>
                </div>
                
                <div class="py-4 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400">Pick-up Date</span>
                        <span class="text-white">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400">Return Date</span>
                        <span class="text-white">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</span>
                    </div>
                    @php
                        $days = \Carbon\Carbon::parse($booking->start_date)->diffInDays(\Carbon\Carbon::parse($booking->end_date));
                        if ($days < 1) $days = 1;
                    @endphp
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400">Duration</span>
                        <span class="text-white">{{ $days }} day{{ $days > 1 ? 's' : '' }}</span>
                    </div>
                </div>
                
                <div class="pt-4 border-t border-slate-700">
                    <div class="flex justify-between text-lg font-bold">
                        <span class="text-white">Total Amount</span>
                        <span class="text-green-400">KES {{ number_format($booking->total_price, 0) }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white/5 border border-cyan-500/10 rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <span class="text-2xl">💳</span> Payment Method
                </h2>
                
                <div class="space-y-4">
                    <div class="p-4 border-2 border-green-500/50 rounded-xl bg-green-500/10 cursor-pointer" id="mpesa-option">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold text-sm">
                                M-P
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-white">M-Pesa</h3>
                                <p class="text-sm text-slate-400">Pay using your Safaricom M-Pesa mobile money</p>
                            </div>
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <form id="mpesa-form" class="mt-6">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    
                    <div class="mb-4">
                        <label class="block text-sm text-slate-400 mb-2">M-Pesa Phone Number</label>
                        <div class="flex">
                            <span class="px-4 py-3 bg-slate-700 border border-r-0 border-slate-600 rounded-l-xl text-white">+254</span>
                            <input type="tel" 
                                   name="phone_number" 
                                   id="phone_number"
                                   placeholder="7XXXXXXXX"
                                   pattern="[0-9]{9}"
                                   maxlength="9"
                                   required
                                   class="flex-1 px-4 py-3 bg-black/50 border border-slate-600 rounded-r-xl text-white focus:border-green-500 focus:outline-none">
                        </div>
                        <p class="text-xs text-slate-500 mt-1">Enter your Safaricom number (e.g., 712345678)</p>
                    </div>
                    
                    <button type="submit" 
                            id="pay-btn"
                            class="w-full py-4 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl font-bold text-lg hover:scale-[1.02] transform transition shadow-lg">
                        Pay KES {{ number_format($booking->total_price, 0) }} via M-Pesa
                    </button>
                </form>
                
                <div id="payment-status" class="hidden mt-6 p-4 rounded-xl text-center">
                </div>
            </div>
        </div>
        
        <div>
            <div class="bg-gradient-to-br from-cyan-500/10 to-blue-500/10 border border-cyan-500/20 rounded-2xl p-6 sticky top-6">
                <h3 class="font-bold text-white mb-4">Need Help?</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-cyan-500/20 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-white font-medium">Call Us</p>
                            <p class="text-xs text-slate-400">+254 793 027 220</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-cyan-500/20 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-white font-medium">Email</p>
                            <p class="text-xs text-slate-400">muhsinabdi288@gmail.com</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 pt-4 border-t border-cyan-500/20">
                    <div class="flex items-center gap-2 text-sm text-slate-400">
                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Secure Payment
                    </div>
                    <p class="text-xs text-slate-500 mt-2">Your payment is secured with end-to-end encryption</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('mpesa-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const btn = document.getElementById('pay-btn');
    const statusDiv = document.getElementById('payment-status');
    const phoneInput = document.getElementById('phone_number');
    
    const phone = '254' + phoneInput.value;
    
    if (phone.length !== 12) {
        statusDiv.classList.remove('hidden', 'bg-green-500/20', 'text-green-400');
        statusDiv.classList.add('bg-red-500/20', 'text-red-400');
        statusDiv.innerHTML = 'Please enter a valid 9-digit phone number';
        return;
    }
    
    btn.disabled = true;
    btn.innerHTML = '<span class="animate-pulse">Processing...</span>';
    
    try {
        const response = await fetch('{{ route("payment.mpesa.initialize") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                phone_number: phone,
                booking_id: {{ $booking->id }}
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            statusDiv.classList.remove('hidden', 'bg-red-500/20', 'text-red-400');
            statusDiv.classList.add('bg-green-500/20', 'text-green-400');
            statusDiv.innerHTML = `
                <div class="text-4xl mb-2">📱</div>
                <p class="font-bold">Check your phone!</p>
                <p class="text-sm mt-1">Enter your M-Pesa PIN to complete payment</p>
            `;
            
            btn.innerHTML = 'Waiting for confirmation...';
            
            setTimeout(() => {
                window.location.href = '{{ route("bookings.show", $booking->id) }}';
            }, 30000);
        } else {
            statusDiv.classList.remove('hidden', 'bg-green-500/20', 'text-green-400');
            statusDiv.classList.add('bg-red-500/20', 'text-red-400');
            statusDiv.innerHTML = data.message || 'Payment initialization failed';
            btn.disabled = false;
            btn.innerHTML = 'Pay KES {{ number_format($booking->total_price, 0) }} via M-Pesa';
        }
    } catch (error) {
        statusDiv.classList.remove('hidden', 'bg-green-500/20', 'text-green-400');
        statusDiv.classList.add('bg-red-500/20', 'text-red-400');
        statusDiv.innerHTML = 'An error occurred. Please try again.';
        btn.disabled = false;
        btn.innerHTML = 'Pay KES {{ number_format($booking->total_price, 0) }} via M-Pesa';
    }
});
</script>
@endpush
@endsection
