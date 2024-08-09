<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

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
