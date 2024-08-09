<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

// Auth Endpoints ------------------------------------------------------------------------
Route::controller(AuthController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::middleware('auth:sanctum')->post('/logout', 'logout');
});

// Category Endpoints --------------------------------------------------------------------
Route::controller(CategoryController::class)->group(function() {
    // storing new category endpoint.
    Route::post('/categories','store');
});

// Item Endpoints ------------------------------------------------------------------------
Route::controller(ItemController::class)->group(function() {
    // storing new item endpoint.
    Route::post('/items','store');
});

// Discount Endpoints --------------------------------------------------------------------
Route::controller(DiscountController::class)->group(function() {
    // storing new discount endpoint.
    Route::post('/discounts','store');
});
