<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - NEXUS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">
    <div class="fixed inset-0 bg-gradient-to-br from-black via-slate-900 to-black"></div>
    @include('partials.header')
    <main class="relative z-10 pt-32 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 py-20">
            <h1 class="text-4xl font-black mb-12">
                <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Checkout</span>
            </h1>
            @if(empty($cart))
            <div class="text-center py-20">
                <div class="text-8xl mb-6">🛒</div>
                <h2 class="text-2xl font-bold mb-4">Your cart is empty</h2>
                <a href="{{ route('marketplace') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl font-bold">Browse Fleet</a>
            </div>
            @else
            <div class="bg-white/5 border border-cyan-500/10 rounded-2xl p-8">
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                @php $total += $item['price'] * (1 - $item['discount']/100) * $item['qty']; @endphp
                <div class="flex items-center gap-6 py-4 border-b border-cyan-500/10">
                    <div class="text-5xl">{{ $item['image'] }}</div>
                    <div class="flex-1">
                        <h3 class="font-bold text-white">{{ $item['name'] }}</h3>
                        <p class="text-sm text-slate-400">{{ $item['qty'] }} days</p>
                    </div>
                    <p class="text-xl font-bold text-cyan-400">KES {{ number_format($item['price'] * (1 - $item['discount']/100) * $item['qty']) }}</p>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-400 hover:text-red-300">Remove</button>
                    </form>
                </div>
                @endforeach
                <div class="pt-6">
                    <div class="flex justify-between text-2xl font-bold">
                        <span>Total:</span>
                        <span class="text-cyan-400">KES {{ number_format($total * 1.21) }}</span>
                    </div>
                    <button class="w-full mt-6 py-4 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl font-bold">Complete Payment</button>
                </div>
            </div>
            @endif
        </div>
    </main>
    @include('partials.footer')
</body>
</html>
