@extends('layouts.app')

@section('title', 'Login - NEXUS')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur-xl border border-cyan-500/20 rounded-3xl p-8 shadow-2xl shadow-cyan-500/10">
            <div class="text-center mb-8">
                <div class="inline-block mb-4">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center mx-auto">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-extrabold text-white mb-2">Welcome Back</h2>
                <p class="text-slate-400">Sign in to continue to NEXUS</p>
            </div>

            <div class="flex rounded-xl bg-slate-800/50 p-1 mb-8">
                <button type="button" onclick="setRole('client')" id="client-tab" 
                        class="flex-1 py-2.5 text-sm font-medium rounded-lg transition-all duration-200">
                    Client
                </button>
                <button type="button" onclick="setRole('admin')" id="admin-tab" 
                        class="flex-1 py-2.5 text-sm font-medium rounded-lg transition-all duration-200">
                    Admin
                </button>
                <button type="button" onclick="setRole('employee')" id="employee-tab" 
                        class="flex-1 py-2.5 text-sm font-medium rounded-lg transition-all duration-200">
                    Employee
                </button>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="role" id="role" value="client">
                
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
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                   class="w-full pl-12 pr-4 py-3.5 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition"
                                   placeholder="Enter your password">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox" 
                               class="h-4 w-4 rounded bg-slate-800 border-slate-600 text-cyan-500 focus:ring-cyan-500 focus:ring-offset-0">
                        <label for="remember-me" class="ml-2 text-sm text-slate-400">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-cyan-400 hover:text-cyan-300 transition">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full py-4 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-bold rounded-xl hover:shadow-lg hover:shadow-cyan-500/25 hover:scale-[1.02] transform transition-all duration-200">
                    Sign In
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-slate-400">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-cyan-400 hover:text-cyan-300 font-medium transition">Create one</a>
                </p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function setRole(role) {
        document.getElementById('role').value = role;
        
        document.querySelectorAll('[id$="-tab"]').forEach(tab => {
            tab.classList.remove('bg-gradient-to-r', 'from-cyan-500', 'to-blue-500', 'text-white', 'shadow-lg');
            tab.classList.add('text-slate-400', 'hover:text-white');
        });
        
        const activeTab = document.getElementById(role + '-tab');
        activeTab.classList.remove('text-slate-400', 'hover:text-white');
        activeTab.classList.add('bg-gradient-to-r', 'from-cyan-500', 'to-blue-500', 'text-white', 'shadow-lg');
    }

    document.addEventListener('DOMContentLoaded', function() {
        setRole('client');
    });
</script>
@endpush
@endsection
