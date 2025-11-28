<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PaymentController;

// Public API routes (no auth required)
Route::apiResource('blogs', BlogController::class);

// M-Pesa STK Push Test Route - SANDBOX ONLY (limited to sandbox environment)
if (config('services.mpesa.env') === 'sandbox') {
    Route::post('/test-stk-push', [PaymentController::class, 'apiTestStkPush']);
}

// Protected API route (requires Sanctum auth)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
