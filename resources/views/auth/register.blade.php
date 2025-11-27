@extends('layouts.app')

@section('title', 'Register - NEXUS')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur-xl border border-cyan-500/20 rounded-3xl p-8 shadow-2xl shadow-cyan-500/10">
            <div class="text-center mb-8">
                <div class="inline-block mb-4">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center mx-auto">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-extrabold text-white mb-2">Create Account</h2>
                <p class="text-slate-400">Join NEXUS and start your journey</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                @if($errors->any())
                    <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/30">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm text-red-400">{{ $errors->first() }}</p>
                        </div>
                    </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-300 mb-2">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input id="name" name="name" type="text" required
                                   class="w-full pl-12 pr-4 py-3.5 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition"
                                   placeholder="Enter your full name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div>
                        <label for="email-address" class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input id="email-address" name="email" type="email" autocomplete="email" required
                                   class="w-full pl-12 pr-4 py-3.5 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition"
                                   placeholder="Enter your email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="new-password" required
                                       class="w-full pl-12 pr-4 py-3.5 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition"
                                       placeholder="Password">
                            </div>
                        </div>

                        <div>
                            <label for="password-confirm" class="block text-sm font-medium text-slate-300 mb-2">Confirm</label>
                            <input id="password-confirm" name="password_confirmation" type="password" autocomplete="new-password" required
                                   class="w-full px-4 py-3.5 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition"
                                   placeholder="Confirm">
                        </div>
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-slate-300 mb-2">Register As</label>
                        <div class="relative">
                            <select id="role" name="role" required
                                    class="w-full px-4 py-3.5 bg-slate-800/50 border border-slate-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition appearance-none cursor-pointer">
                                @foreach($roles as $r)
                                    <option value="{{ $r }}" {{ old('role') == $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-start gap-3 py-2">
                    <input id="terms" name="terms" type="checkbox" required
                           class="mt-1 h-4 w-4 rounded bg-slate-800 border-slate-600 text-cyan-500 focus:ring-cyan-500 focus:ring-offset-0">
                    <label for="terms" class="text-sm text-slate-400">
                        I agree to the <a href="#" class="text-cyan-400 hover:text-cyan-300">Terms of Service</a> and <a href="#" class="text-cyan-400 hover:text-cyan-300">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit" class="w-full py-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-bold rounded-xl hover:shadow-lg hover:shadow-purple-500/25 hover:scale-[1.02] transform transition-all duration-200">
                    Create Account
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-slate-400">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-300 font-medium transition">Sign in</a>
                </p>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-3 gap-4">
            <div class="text-center p-4 bg-slate-900/50 border border-cyan-500/10 rounded-xl">
                <div class="text-2xl font-bold text-cyan-400">50K+</div>
                <div class="text-xs text-slate-400">Happy Users</div>
            </div>
            <div class="text-center p-4 bg-slate-900/50 border border-cyan-500/10 rounded-xl">
                <div class="text-2xl font-bold text-purple-400">4.9/5</div>
                <div class="text-xs text-slate-400">Rating</div>
            </div>
            <div class="text-center p-4 bg-slate-900/50 border border-cyan-500/10 rounded-xl">
                <div class="text-2xl font-bold text-pink-400">100K+</div>
                <div class="text-xs text-slate-400">Rentals</div>
            </div>
        </div>
    </div>
</div>
@endsection
