<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Produk\ProdukController;
use App\Http\Middleware\Auth\SessionHasMiddleware;
use App\Http\Middleware\Auth\SessionHasNotMiddleware;


Route::get('/', [UserController::class, 'index']);

Route::controller(LoginController::class)->prefix('/login')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasMiddleware::class);
    Route::post('/index/post', 'doLogin');
});

Route::controller(RegisterController::class)->prefix('/register')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasMiddleware::class);
    Route::post('/index', 'doRegister');
});

Route::controller(ProdukController::class)->prefix('/produk')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasNotMiddleware::class);
});
