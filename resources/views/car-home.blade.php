<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS - Premium Car Rentals</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">
    <div class="fixed inset-0 bg-gradient-to-br from-black via-slate-900 to-black"></div>
    
    <header class="fixed top-0 w-full z-50 bg-black/80 backdrop-blur-xl border-b border-cyan-500/20">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center gap-3">
                <span class="text-3xl">🚗</span>
                <div>
                    <div class="text-2xl font-black bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">NEXUS</div>
                    <div class="text-xs text-cyan-400">PREMIUM CARS</div>
                </div>
            </a>
            <nav class="flex gap-6">
                <a href="/" class="text-slate-300 hover:text-cyan-400">Home</a>
                <a href="/marketplace" class="text-slate-300 hover:text-cyan-400">Fleet</a>
                <a href="/checkout" class="text-slate-300 hover:text-cyan-400">Cart ({{ session('cart') ? count(session('cart')) : 0 }})</a>
            </nav>
        </div>
    </header>

    <main class="relative z-10 pt-32 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h1 class="text-7xl font-black mb-6">
                    <span class="block bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-500 bg-clip-text text-transparent">Premium Car</span>
                    <span class="block">Services</span>
                </h1>
                <p class="text-xl text-slate-300 mb-8">Experience luxury travel with NEXUS</p>
                <a href="/marketplace" class="inline-block px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl font-bold hover:scale-105 transform transition">
                    Explore Fleet
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-20">
                @foreach($products->take(3) as $product)
                <div class="bg-white/5 border border-cyan-500/20 rounded-2xl overflow-hidden hover:border-cyan-500/50 transition">
                    <div class="h-64 bg-gradient-to-br from-slate-800 to-black flex items-center justify-center text-8xl">
                        {{ $product['image'] }}
                    </div>
                    <div class="p-6">
                        <span class="text-cyan-400 text-xs font-bold">{{ $product['category'] }}</span>
                        <h3 class="text-xl font-bold text-white my-2">{{ $product['name'] }}</h3>
                        <p class="text-slate-400 text-sm mb-4">{{ $product['desc'] }}</p>
                        <div class="flex justify-btml>
dy>
</hbo
</ </footer>iv>
         </d
  ved.</p>ghts reserri Cars. All US Premium024 NEX>© 2e-400"t-slat="texlassp c  <
          ">ercentext--auto px-4 txl mx"max-w-7 class=        <div
-8">ack/90 py500/20 bg-blyan-er-cder-t bordive z-10 borass="relater cl    <foot </main>

</div>
        
      </div>     
    ach @endfore               
div>          </
           </div>        >
          </div                 /a>
        <                    iew
             V                   
    sition">60 tran-cyan-500/ver:bgfont-bold hod-lg 0 roundecyan-500/4py-2 bg-s="px-4 as" clt['id'] }}{ $produc="/cars/{efhr     <a                         </div>
                       ay</p>
    0">/d50xt-slate-te-xs ss="text    <p cla                            )) }}</p>
ount']/100oduct['disc1 - $prce'] * (priduct['ormat($pror_fbe {{ num400">KES-cyan-ck textont-blaext-2xl fclass="t<p                          
         <div>                          nter">
-ceetween items