<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
*/

// Sign Up
Route::get('/signup', [AuthController::class, 'showSignUpForm']);
Route::post('/signup', [AuthController::class, 'processSignUp']);

// Home
Route::get('/home', [ProductController::class, 'index']); // Display products (GET)

// Product Routes
Route::get('/products', [ProductController::class, 'index']); // Display list of products (GET)
Route::post('/products', [ProductController::class, 'store']); // Create new product (POST)
Route::get('/products/create', [ProductController::class, 'create']); // Show form to create a new product (GET)
Route::get('/products/{id}/edit', [ProductController::class, 'edit']); // Show form to edit a product (GET)
Route::put('/products/{id}', [ProductController::class, 'update']); // Update a product (PUT)
Route::delete('/products/{id}', [ProductController::class, 'destroy']); // Delete a product (DELETE)

