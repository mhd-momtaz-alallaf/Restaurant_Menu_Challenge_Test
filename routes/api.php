<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Category endpoints --------------------------------------------------------------------
Route::controller(CategoryController::class)->group(function() {
    // storing new category endpoint.
    Route::post('/categories','store');
});
