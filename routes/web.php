<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Produk\ProdukController;
use App\Http\Middleware\Auth\SessionHasMiddleware;
use App\Http\Middleware\Auth\SessionHasNotMiddleware;
use Illuminate\Support\Carbon;

Route::get('/', [UserController::class, 'index']);

Route::controller(LoginController::class)->prefix('/login')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasMiddleware::class);
    Route::post('/index/post', 'doLogin');
});
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');

Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');

Route::controller(RegisterController::class)->prefix('/register')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasMiddleware::class);
    Route::post('/index', 'doRegister');
});

Route::controller(ProdukController::class)->prefix('/produk')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasNotMiddleware::class);
});

Route::get('/tanggal',function(){
    echo now();
});
