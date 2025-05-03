<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\SessionHasMiddleware;
use App\Http\Controllers\ImportWilayahController;


Route::get('/', [UserController::class, 'index']);

Route::get('/login/index',[LoginController::class, 'index'])->middleware(SessionHasMiddleware::class);
Route::post('/login/index/post', [LoginController::class, 'doLogin']);
Route::get('/register/index',[RegisterController::class, 'index']);
Route::post('/register/index',[RegisterController::class, 'doRegister'])->name('register-proses');