<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| File ini memetakan seluruh rute web aplikasi.
| - Dashboard publik
| - Auth (guest-only + logout)
| - Products (publik) dengan detail by ID dan by Slug
| - Cart (wajib login)
*/

/**
 * Dashboard sebagai halaman utama (accessible untuk semua orang)
 */
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

/**
 * Auth Routes - Hanya untuk guest (belum login)
 */
Route::middleware('guest')->group(function () {
    // Halaman Auth (Login & Register dalam satu halaman)
    Route::get('/auth', [AuthController::class, 'showAuthForm'])->name('auth');

    // Login
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Register
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

/**
 * Logout Route - Protected by auth middleware
 */
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/**
 * Product Routes (accessible untuk semua orang)
 * - /products                     -> index (list + filter + sort + paginate)
 * - /products/{id}                -> detail by ID (hanya numerik)
 * - /products/slug/{slug}         -> detail by Slug (hindari bentrok dengan ID)
 *
 * Catatan:
 * - Tambahkan whereNumber('id') agar tidak bentrok dengan slug.
 * - Endpoint slug dipisah ke prefix /products/slug/... supaya jelas.
 */
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/{id}', [ProductController::class, 'detail'])
    ->whereNumber('id')
    ->name('products.detail');

Route::get('/products/slug/{slug}', [ProductController::class, 'show'])
    ->where('slug', '[A-Za-z0-9\-_.]+')
    ->name('products.show');

/**
 * Cart Routes - HARUS LOGIN (protected by auth middleware)
 * - /cart                         -> halaman cart
 * - /cart/add/{product}           -> tambah item (POST)
 * - /cart/update/{product}        -> update qty (POST)
 * - /cart/remove/{product}        -> hapus 1 item (DELETE)
 * - /cart/clear                   -> kosongkan cart (POST)
 *
 * Catatan:
 * - Parameter {product} akan mengirim ID produk ke controller.
 * - Pastikan form memakai method & CSRF yang sesuai (POST/DELETE).
 */
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
});
