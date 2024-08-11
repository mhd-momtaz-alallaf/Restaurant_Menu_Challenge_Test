<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

// Auth Endpoints ------------------------------------------------------------------------
Route::controller(AuthController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::middleware('auth:sanctum')->post('/logout', 'logout');
});

Route::middleware('auth:sanctum')->group(function() {
    // Category Endpoints --------------------------------------------------------------------
    Route::controller(CategoryController::class)->group(function() {
        // storing new category endpoint.
        Route::post('/categories','store');

        // Showing all categories endpoint.
        Route::get('/categories', 'index');
    });

    // Item Endpoints ------------------------------------------------------------------------
    Route::controller(ItemController::class)->group(function() {
        // storing new item endpoint.
        Route::post('/items','store');

        // Showing all Items endpoint.
        Route::get('/items', 'index');
    });

    // Discount Endpoints --------------------------------------------------------------------
    Route::controller(DiscountController::class)->group(function() {
        // storing new discount endpoint.
        Route::post('/discounts','store');
    });

    // Menu Endpoints ------------------------------------------------------------------------
    Route::controller(MenuController::class)->group(function() {
        // finalizing the menu endpoint.
        Route::post('/menu/finalize', 'finalizeMenu');

        // get the menu endpoint.
        Route::get('/menu', 'index');
    });
});
