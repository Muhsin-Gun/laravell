<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarRentalController;

// Car Rental Routes
Route::get('/', [CarRentalController::class, 'index'])->name('home');
Route::get('/marketplace', [CarRentalController::class, 'marketplace'])->name('marketplace');
Route::get('/cars/{id}', [CarRentalController::class, 'show'])->name('cars.show');
Route::post('/cart/add', [CarRentalController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/{id}', [CarRentalController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [CarRentalController::class, 'checkout'])->name('checkout');
