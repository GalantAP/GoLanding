<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

// Dashboard sebagai halaman utama (accessible untuk semua orang)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Auth Routes - Hanya untuk guest (belum login)
Route::middleware('guest')->group(function () {
    // Halaman Auth (Login & Register dalam satu halaman)
    Route::get('/auth', [AuthController::class, 'showAuthForm'])->name('auth');
    
    // Login
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    // Register
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Logout Route - Protected by auth middleware
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Product Routes (accessible untuk semua orang)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'detail'])->name('products.detail');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.detail');