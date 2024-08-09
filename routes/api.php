<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
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
