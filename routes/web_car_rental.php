<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\EmployeeController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
Route::get('/help', function() { return view('help'); })->name('help');

// Auth Routes
Route::get('/login', [ProfileController::class, 'showLoginForm'])->name('login');
Route::post('/login', [ProfileController::class, 'login']);
Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
Route::get('/register', [ProfileController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [ProfileController::class, 'register']);

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Client Dashboard & Profile
    Route::get('/dashboard', [DashboardController::class, 'client'])->name('dashboard.client');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Bookings
    Route::post('/cars/{car}/book', [BookingController::class, 'book'])->name('cars.book');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');

    // Payment via M-PESA
    Route::post('/payment/mpesa/initialize', [PaymentController::class, 'initialize'])->name('payment.mpesa.initialize');
    Route::post('/payment/mpesa/callback', [PaymentController::class, 'callback'])->name('payment.mpesa.callback');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::resource('cars', AdminCarController::class);
    Route::resource('users', AdminUserController::class);
});

// Employee Routes
Route::middleware(['auth', 'role:employee'])->prefix('employee')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'employee'])->name('employee.dashboard');
    Route::post('/booking/{booking}/action', [EmployeeController::class, 'approve'])->name('employee.approve');
});
