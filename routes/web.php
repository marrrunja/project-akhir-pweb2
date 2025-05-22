<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Produk\ProdukController;
use App\Http\Controllers\Transaksi\TransaksiController;
use App\Http\Middleware\Auth\SessionHasMiddleware;
use App\Http\Middleware\Auth\SessionHasNotMiddleware;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

Route::get('/', [UserController::class, 'index']);

Route::controller(LoginController::class)->prefix('/login')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasMiddleware::class);
    Route::post('/index/post', 'doLogin');
    Route::post('/logout', 'logout');
});
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');


Route::controller(RegisterController::class)->prefix('/register')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasMiddleware::class);
    Route::post('/index', 'doRegister');
});

Route::controller(ProdukController::class)->prefix('/produk')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasNotMiddleware::class);
    Route::get('/variant', 'produkVariant')->middleware(SessionHasNotMiddleware::class)->name('produk.variant');
});

Route::controller(TransaksiController::class)->prefix('/transaksi')->group(function(){
    Route::post('/index/{id}', 'index')->name('transaksi.order');
    Route::post('/checkout', 'makeOrder');
    Route::get('/checkout/success', 'orderSuccess');
    Route::get('/checkout/fail', 'orderFail');
});

Route::get('/tanggal',function(){
    echo now()->format('Y-m-d');
});

Route::get('/check', function(){
    return view('checkbox');
});
Route::post('/check', function(Request $request){
    dump($request->all());
});
