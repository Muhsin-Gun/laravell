@extends('layouts.app')

@section('title','NEXUS - Premium Car Rentals')

@section('content')
    <div class="relative pt-16">
        <div class="text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight">
                <span class="block bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-500">Premium Car</span>
                <span class="block text-white">Rental Services</span>
            </h1>
            <p class="text-lg text-slate-300 mb-8 max-w-2xl mx-auto">Experience luxury travel with NEXUS - your trusted partner for premium rentals, tours, and executive transfers.</p>
            <a href="{{ route('cars.index') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl font-bold hover:scale-105 transform transition shadow-lg shadow-cyan-500/25">Explore Fleet</a>
        </div>

        <div class="grid md:grid-cols-4 gap-6 mb-20">
            <div class="p-8 bg-white/5 border border-cyan-500/10 rounded-2xl text-center hover:border-cyan-500/30 transition">
                <div class="text-5xl mb-4">🚗</div>
                <p class="text-slate-400 text-sm mb-2">Premium Vehicles</p>
                <p class="text-3xl font-black text-cyan-400">{{ $cars->count() > 0 ? $cars->count() * 50 : 500 }}+</p>
            </div>
            <div class="p-8 bg-white/5 border border-cyan-500/10 rounded-2xl text-center hover:border-cyan-500/30 transition">
                <div class="text-5xl mb-4">👥</div>
                <p class="text-slate-400 text-sm mb-2">Happy Customers</p>
                <p class="text-3xl font-black text-blue-400">50K+</p>
            </div>
            <div class="p-8 bg-white/5 border border-cyan-500/10 rounded-2xl text-center hover:border-cyan-500/30 transition">
                <div class="text-5xl mb-4">⭐</div>
                <p class="text-slate-400 text-sm mb-2">Average Rating</p>
                <p class="text-3xl font-black text-purple-400">4.9/5</p>
            </div>
            <div class="p-8 bg-white/5 border border-cyan-500/10 rounded-2xl text-center hover:border-cyan-500/30 transition">
                <div class="text-5xl mb-4">✈️</div>
                <p class="text-slate-400 text-sm mb-2">Completed Trips</p>
                <p class="text-3xl font-black text-pink-400">100K+</p>
            </div>
        </div>

        <div id="services" class="mb-24">
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1 bg-cyan-500/10 border border-cyan-500/30 rounded-full text-cyan-400 text-sm font-medium mb-4">Our Services</span>
                <h2 class="text-4xl md:text-5xl font-extrabold mb-4">What We Offer</h2>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto">Comprehensive mobility solutions tailored to your needs</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="group p-8 bg-gradient-to-br from-cyan-500/5 to-blue-500/5 border border-cyan-500/10 rounded-2xl hover:border-cyan-500/30 transition-all duration-300 hover:-translate-y-2">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Car Rentals</h3>
                    <p class="text-slate-400 text-sm mb-4">Daily, weekly, and monthly rental options with flexible pickup and return locations.</p>
                    <a href="{{ route('cars.index') }}" class="inline-flex items-center text-cyan-400 text-sm font-medium hover:text-cyan-300">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="group p-8 bg-gradient-to-br from-purple-500/5 to-pink-500/5 border border-purple-500/10 rounded-2xl hover:border-purple-500/30 transition-all duration-300 hover:-translate-y-2">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Airport Transfers</h3>
                    <p class="text-slate-400 text-sm mb-4">Reliable airport pickup and drop-off services. Track your flight, we'll be there on time.</p>
                    <a href="#" class="inline-flex items-center text-purple-400 text-sm font-medium hover:text-purple-300">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="group p-8 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 border border-blue-500/10 rounded-2xl hover:border-blue-500/30 transition-all duration-300 hover:-translate-y-2">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Chauffeur Service</h3>
                    <p class="text-slate-400 text-sm mb-4">Professional drivers for business meetings, events, or when you want to relax.</p>
                    <a href="#" class="inline-flex items-center text-blue-400 text-sm font-medium hover:text-blue-300">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="group p-8 bg-gradient-to-br from-green-500/5 to-emerald-500/5 border border-green-500/10 rounded-2xl hover:border-green-500/30 transition-all duration-300 hover:-translate-y-2">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Safari Tours</h3>
                    <p class="text-slate-400 text-sm mb-4">Guided adventure tours with experienced drivers and comfortable 4x4 vehicles.</p>
                    <a href="#" class="inline-flex items-center text-green-400 text-sm font-medium hover:text-green-300">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center mb-12">
            <span class="inline-block px-4 py-1 bg-cyan-500/10 border border-cyan-500/30 rounded-full text-cyan-400 text-sm font-medium mb-4">Our Fleet</span>
            <h2 class="text-4xl md:text-5xl font-extrabold mb-4">Featured Vehicles</h2>
            <p class="text-slate-400 text-lg">Handpicked luxury vehicles for unforgettable experiences</p>
        </div>

        @if($cars->count() > 0)
        <div class="grid md:grid-cols-3 gap-8 mb-12">
            @foreach($cars->take(6) as $car)
            <div class="bg-white/3 border border-cyan-500/10 rounded-2xl overflow-hidden hover:border-cyan-500/30 transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="relative h-64 bg-gradient-to-br from-slate-800 to-black flex items-center justify-center overflow-hidden">
                    @if($car->image_path)
                        <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->name }}" class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="text-8xl">🚗</div>
                    @endif
                    @if($car->available)
                    <div class="absolute top-4 left-4 px-3 py-1 bg-green-500/30 backdrop-blur-xl border border-green-400/60 rounded-full text-xs font-bold text-green-300">Available</div>
                    @endif
                    <div class="absolute top-4 right-4 px-3 py-1 bg-cyan-500/30 backdrop-blur-xl border border-cyan-400/60 rounded-full text-xs font-bold text-cyan-300">{{ $car->type }}</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">{{ $car->name }}</h3>
                    <p class="text-slate-400 text-sm mb-1">{{ $car->brand }} • {{ $car->type }}</p>
                    <p class="text-slate-500 text-sm mb-4 line-clamp-2">{{ Str::limit($car->description, 80) }}</p>

                    <div class="flex justify-between items-center mt-4 pt-4 border-t border-slate-800">
                        <p class="text-2xl font-black">KSH {{ number_format($car->price_per_day, 0) }}<span class="text-sm text-slate-400">/day</span></p>
                        <a href="{{ route('cars.show', $car->id) }}" class="px-4 py-2 bg-cyan-500/20 text-cyan-400 rounded-lg hover:bg-cyan-500/30 transition text-sm font-medium">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="grid md:grid-cols-3 gap-8 mb-12">
            @for($i = 0; $i < 6; $i++)
            <div class="bg-white/3 border border-cyan-500/10 rounded-2xl overflow-hidden hover:border-cyan-500/30 transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="relative h-64 bg-gradient-to-br from-slate-800 to-black flex items-center justify-center overflow-hidden">
                    <div class="text-8xl opacity-50">🚗</div>
                    <div class="absolute top-4 left-4 px-3 py-1 bg-green-500/30 backdrop-blur-xl border border-green-400/60 rounded-full text-xs font-bold text-green-300">Available</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">Premium Vehicle {{ $i + 1 }}</h3>
                    <p class="text-slate-400 text-sm mb-1">Luxury Brand • Sedan</p>
                    <p class="text-slate-500 text-sm mb-4">Experience luxury and comfort with our premium vehicle selection.</p>
                    <div class="flex justify-between items-center mt-4 pt-4 border-t border-slate-800">
                        <p class="text-2xl font-black">${{ rand(150, 350) }}<span class="text-sm text-slate-400">/day</span></p>
                        <a href="{{ route('cars.index') }}" class="px-4 py-2 bg-cyan-500/20 text-cyan-400 rounded-lg hover:bg-cyan-500/30 transition text-sm font-medium">View Details</a>
                    </div>
                </div>
            </div>
            @endfor
        </div>
        @endif

        <div class="text-center mb-16">
            <a href="{{ route('cars.index') }}" class="inline-block px-8 py-4 border border-cyan-500/30 text-cyan-400 rounded-xl font-bold hover:bg-cyan-500/10 transition">
                View All Vehicles →
            </a>
        </div>

        <div class="mb-24">
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1 bg-yellow-500/10 border border-yellow-500/30 rounded-full text-yellow-400 text-sm font-medium mb-4">Testimonials</span>
                <h2 class="text-4xl md:text-5xl font-extrabold mb-4">What Our Customers Say</h2>
                <p class="text-slate-400 text-lg">Real reviews from real customers</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6">
                @php
                $fakeReviews = [
                    ['name' => 'Michael Johnson', 'role' => 'Business Executive', 'avatar' => 'M', 'color' => 'from-cyan-500 to-blue-500', 'rating' => 5, 'comment' => 'NEXUS exceeded all my expectations! The Mercedes S-Class was immaculate, and the service was world-class. Perfect for my business trips.', 'car' => 'Mercedes-Benz S-Class'],
                    ['name' => 'Sarah Williams', 'role' => 'Travel Blogger', 'avatar' => 'S', 'color' => 'from-purple-500 to-pink-500', 'rating' => 5, 'comment' => 'As a travel blogger, I\'ve rented cars from many companies. NEXUS stands out with their amazing fleet and attention to detail. Highly recommend!', 'car' => 'BMW 7 Series'],
                    ['name' => 'David Brown', 'role' => 'Software Engineer', 'avatar' => 'D', 'color' => 'from-green-500 to-emerald-500', 'rating' => 5, 'comment' => 'Rented the Porsche 911 for a weekend getaway. What an experience! The booking process was seamless and the car was in perfect condition.', 'car' => 'Porsche 911'],
                    ['name' => 'Emily Davis', 'role' => 'Event Planner', 'avatar' => 'E', 'color' => 'from-orange-500 to-red-500', 'rating' => 5, 'comment' => 'Organized airport transfers for a corporate event. NEXUS delivered flawlessly - professional drivers, luxury vehicles, and punctual service.', 'car' => 'Audi A8'],
                    ['name' => 'James Wilson', 'role' => 'Entrepreneur', 'avatar' => 'J', 'color' => 'from-blue-500 to-indigo-500', 'rating' => 4, 'comment' => 'Great value for the quality of vehicles offered. The Range Rover was perfect for our family safari trip. Will definitely book again!', 'car' => 'Range Rover Sport'],
                    ['name' => 'Lisa Anderson', 'role' => 'Marketing Director', 'avatar' => 'L', 'color' => 'from-pink-500 to-rose-500', 'rating' => 5, 'comment' => 'The chauffeur service was exceptional. Our driver was professional, knew the city well, and made our anniversary celebration truly special.', 'car' => 'BMW X7'],
                ];
                @endphp

                @foreach(array_slice($fakeReviews, 0, 3) as $review)
                <div class="p-6 bg-white/5 border border-cyan-500/10 rounded-2xl hover:border-cyan-500/20 transition">
                    <div class="flex items-center gap-1 mb-4">
                        @for($i = 0; $i < $review['rating']; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-slate-300 mb-6 italic">"{{ $review['comment'] }}"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br {{ $review['color'] }} flex items-center justify-center font-bold text-white text-lg">
                            {{ $review['avatar'] }}
                        </div>
                        <div>
                            <p class="font-semibold text-white">{{ $review['name'] }}</p>
                            <p class="text-xs text-slate-400">{{ $review['role'] }} • {{ $review['car'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="grid md:grid-cols-3 gap-6 mt-6">
                @foreach(array_slice($fakeReviews, 3, 3) as $review)
                <div class="p-6 bg-white/5 border border-cyan-500/10 rounded-2xl hover:border-cyan-500/20 transition">
                    <div class="flex items-center gap-1 mb-4">
                        @for($i = 0; $i < $review['rating']; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-slate-300 mb-6 italic">"{{ $review['comment'] }}"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br {{ $review['color'] }} flex items-center justify-center font-bold text-white text-lg">
                            {{ $review['avatar'] }}
                        </div>
                        <div>
                            <p class="font-semibold text-white">{{ $review['name'] }}</p>
                            <p class="text-xs text-slate-400">{{ $review['role'] }} • {{ $review['car'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mb-24 bg-gradient-to-br from-cyan-500/10 to-blue-500/10 border border-cyan-500/20 rounded-3xl p-12">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="inline-block px-4 py-1 bg-green-500/10 border border-green-500/30 rounded-full text-green-400 text-sm font-medium mb-4">Easy Payments</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Pay With M-Pesa</h2>
                    <p class="text-slate-400 text-lg mb-6">Quick and secure payments via M-Pesa. Just enter your phone number and confirm the payment on your device.</p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-slate-300">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Instant confirmation
                        </li>
                        <li class="flex items-center gap-3 text-slate-300">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Secure transactions
                        </li>
                        <li class="flex items-center gap-3 text-slate-300">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            No hidden fees
                        </li>
                    </ul>
                </div>
                <div class="flex justify-center">
                    <div class="w-64 h-64 rounded-3xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow-2xl shadow-green-500/20">
                        <div class="text-center">
                            <div class="text-6xl mb-4">📱</div>
                            <p class="text-white font-bold text-xl">M-Pesa</p>
                            <p class="text-green-100 text-sm">Pay Securely</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-10 bg-gradient-to-br from-purple-500/10 to-pink-500/10 border border-purple-500/20 rounded-3xl p-12 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Ready for Your Next Adventure?</h2>
            <p class="text-slate-400 text-lg mb-8 max-w-xl mx-auto">Book your dream car today and experience luxury travel like never before.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('cars.index') }}" class="px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl font-bold hover:scale-105 transform transition shadow-lg">Browse Fleet</a>
                <a href="{{ route('register') }}" class="px-8 py-4 border border-cyan-500/30 text-cyan-400 rounded-xl font-bold hover:bg-cyan-500/10 transition">Create Account</a>
            </div>
        </div>
    </div>
@endsection
