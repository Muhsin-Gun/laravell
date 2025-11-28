<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\ReportsController;
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
    Route::resource('blogs', AdminBlogController::class);
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
    Route::get('/reports/export', [ReportsController::class, 'export'])->name('reports.export');
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
    Route::get('/dashboard', [DashboardController::class, 'client'])->name('dashboard.client');
    
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::post('/cars/{car}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    
    Route::get('/checkout/{booking}', [BookingController::class, 'checkout'])->name('checkout');
    Route::post('/payment/mpesa/initialize', [PaymentController::class, 'initialize'])->name('payment.mpesa.initialize');
});

// Payment Callbacks (Public - no auth needed for M-Pesa callback)
Route::post('/payment/mpesa/callback', [PaymentController::class, 'callback'])->name('payment.mpesa.callback');

// Test STK Push Route (admin only - for testing M-Pesa integration)
Route::middleware(['auth', 'role:admin'])->get('/admin/test-stk-push', [PaymentController::class, 'testStkPush'])->name('payment.test.stk');

// Common Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/payment/status/{booking}', [PaymentController::class, 'checkStatus'])->name('payment.status');
});
