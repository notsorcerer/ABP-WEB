<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Endpoints untuk mobile app (Flutter) - menggunakan Sanctum token auth.
| Prefix: /api
|
*/

// ─── Public Endpoints ───
Route::get('products', [ProductController::class, 'index']);
Route::get('products/home', [ProductController::class, 'home']);
Route::get('products/{product}', [ProductController::class, 'show']);
Route::get('categories', [CategoryController::class, 'index']);

// ─── Auth Endpoints (Public) ───
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

// ─── Protected Endpoints (Sanctum) ───
Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/user', [AuthController::class, 'user']);

    Route::get('cart', [CartController::class, 'index']);
    Route::post('cart/{product}', [CartController::class, 'add']);
    Route::put('cart/{product}', [CartController::class, 'update']);
    Route::delete('cart/{product}', [CartController::class, 'remove']);

    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/{order}', [OrderController::class, 'show']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::get('orders/{order}/payment', [OrderController::class, 'paymentConfirmation']);
});
