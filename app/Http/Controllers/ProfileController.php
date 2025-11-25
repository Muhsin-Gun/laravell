<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $role = $request->input('role', 'client');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if ($user->role !== $role) {
                Auth::logout();
                return redirect()->back()->withErrors('You are not authorized to access this area.');
            }

            return match($user->role) {
                'admin' => redirect()->route('dashboard.admin'),
                'employee' => redirect()->route('employee.dashboard'),
                default => redirect()->route('dashboard.client')
            };
        }

        return redirect()->back()->withErrors('Invalid credentials. Please try again.');
    }

    public function showRegisterForm()
    {
        return view('auth.register', ['roles' => ['client', 'employee']]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required|in:client,employee'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        Auth::login($user);
        return redirect()->route('dashboard.' . $request->role);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user->update($request->only('name', 'email'));

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('public/avatars');
            $user->avatar_path = $path;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile updated.');
    }
}
