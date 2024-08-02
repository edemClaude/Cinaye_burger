<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Burgers
Route::apiResource('/burgers', \App\Http\Controllers\Api\BurgerController::class)
    ->except('destroy');
Route::put('/burgers/{burger}/archive', [\App\Http\Controllers\Api\BurgerController::class, 'archive']);
Route::put('/burgers/{burger}/restore', [\App\Http\Controllers\Api\BurgerController::class, 'restore']);


// Customers
Route::apiResource('/customers', \App\Http\Controllers\Api\CustomerController::class)
    ->except('destroy', 'update', 'show');
Route::get('/customers/{customer}/orders', [\App\Http\Controllers\Api\CustomerController::class, 'customerOrders']);

// Orders
Route::apiResource('/orders', \App\Http\Controllers\Api\OrderController::class);
Route::put('/order/{order}/canceled', [\App\Http\Controllers\Api\OrderController::class, 'canceled']);
Route::put('/order/{order}/sold', [\App\Http\Controllers\Api\OrderController::class, 'sold']);

// Auth
Route::post('/register', [\App\Http\Controllers\Auth\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

// Payment
Route::apiResource('/payments', \App\Http\Controllers\Api\PaymentController::class);
Route::put('/payment/{payment}/paid', [\App\Http\Controllers\Api\PaymentController::class, 'paid']);

// User
Route::apiResource('/users', \App\Http\Controllers\Api\UserController::class);
Route::put('/users/{user}/active', [\App\Http\Controllers\Api\UserController::class, 'active']);
Route::put('/users/{user}/deactivate', [\App\Http\Controllers\Api\UserController::class, 'deactivate']);

// Dashboard

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

