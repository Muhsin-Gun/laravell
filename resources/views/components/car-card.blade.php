@props(['car'])
<div {{ $attributes->merge(['class' => 'bg-white/5 border border-cyan-500/20 rounded-xl overflow-hidden hover:border-cyan-500/50 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300']) }}>
    <div class="relative h-48 bg-gradient-to-br from-slate-800 to-black flex items-center justify-center text-6xl">
        @if($car->image_path)
            <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->name }}" class="object-cover w-full h-full">
        @else
            <div class="text-6xl">🚗</div>
        @endif
    </div>
    <div class="p-4">
        <p class="text-cyan-400 text-xs font-bold uppercase mb-1">{{ $car->type ?? 'Vehicle' }}</p>
        <h3 class="font-bold text-white text-sm mb-2">{{ $car->name }}</h3>
        <div class="flex items-center gap-1 mb-3">
            <span class="text-yellow-400 text-xs">★</span>
            <span class="text-xs text-yellow-400 font-bold">{{ number_format($car->reviews_count ?? 0, 1) }}</span>
            <span class="text-xs text-slate-500">({{ $car->reviews_count ?? 0 }})</span>
        </div>
        <div class="flex justify-between items-center">
            <div>
                <p class="font-black text-cyan-400 text-sm">KES {{ number_format($car->price_per_day, 0) }}</p>
                <p class="text-xs text-slate-500">/day</p>
            </div>
            <form action="{{ route('bookings.store', $car->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-3 py-1 bg-cyan-500/40 rounded text-xs font-bold hover:bg-cyan-500/60 transform hover:scale-105 transition-all">Book</button>
            </form>
        </div>
    </div>
</div>
