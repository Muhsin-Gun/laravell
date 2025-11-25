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
Route::get('/marketplace', [CarController::class, 'index'])->name('marketplace');
Route::get('/help', function() { return view('help'); })->name('help');

// Auth Routes (Public)
Route::middleware('guest')->group(function () {
    Route::get('/login', [ProfileController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ProfileController::class, 'login']);
    Route::get('/register', [ProfileController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [ProfileController::class, 'register']);
});

// Logout Route (Authenticated Users)
Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    Route::resource('cars', AdminCarController::class);
    Route::resource('users', AdminUserController::class);
});

// Employee Routes
Route::middleware(['auth', 'role:employee'])->prefix('employee')->name('employee.')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'employee'])->name('dashboard');
    Route::get('/bookings', [BookingController::class, 'employeeIndex'])->name('bookings.index');
    Route::post('/booking/{booking}/approve', [EmployeeController::class, 'approve'])->name('bookings.approve');
    Route::post('/booking/{booking}/reject', [EmployeeController::class, 'reject'])->name('bookings.reject');
});

// Client Routes
Route::middleware(['auth', 'role:client'])->group(function () {
    // Client Dashboard
    Route::get('/dashboard', [DashboardController::class, 'client'])->name('dashboard.client');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Car Booking
    Route::post('/cars/{car}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');

    // Checkout & Payment
    // Use a distinct path/name for the cart-based checkout to avoid collisions with the car-rental checkout route.
    Route::get('/checkout/cart', [BookingController::class, 'checkout'])->name('checkout.cart');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
});

// Payment Callbacks (Public)
Route::post('/payment/mpesa/callback', [PaymentController::class, 'callback'])->name('payment.mpesa.callback');

// Common Authenticated Routes
Route::middleware('auth')->group(function () {
    // Common profile routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Payment Status Check
    Route::get('/payment/status/{booking}', [PaymentController::class, 'checkStatus'])->name('payment.status');
});
