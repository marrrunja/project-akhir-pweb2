<?php

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Produk\ProdukController;
use App\Http\Middleware\Auth\SessionHasMiddleware;
use App\Http\Middleware\Auth\SessionHasNotMiddleware;
use App\Http\Controllers\Transaksi\TransaksiController;
use App\Http\Controllers\Api\ProdukVariantApiController;

Route::get('/', [UserController::class, 'index']);

Route::controller(LoginController::class)->prefix('/login')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasMiddleware::class);
    Route::post('/index/post', 'doLogin');
    Route::post('/logout', 'logout');
});
Route::controller(RegisterController::class)->prefix('/cart')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasNotMiddleware::class);
    Route::post('/index', 'doLogin');
    Route::post('/store', [CartController::class, 'store'])->name('cart.store');
    Route::get('/', [CartController::class, 'cart'])->name('cart.index');
    Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');
});


Route::controller(RegisterController::class)->prefix('/register')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasMiddleware::class);
    Route::post('/index', 'doRegister');
});


Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'index'])->middleware(SessionHasNotMiddleware::class)->name('cart.index');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/delete', [CartController::class, 'destroy'])->name('cart.delete');

Route::controller(ProdukController::class)->prefix('/produk')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasNotMiddleware::class);
    Route::get('/variant/{id}', 'produkVariant')->middleware(SessionHasNotMiddleware::class)->name('produk.variant');
    Route::post('/add', 'addProduk')->name('produk.tambah');
    Route::post('/variant/tambah/{id}', 'addProdukVariant');
    Route::post('/search', 'search')->middleware(SessionHasNotMiddleware::class);
});

Route::controller(TransaksiController::class)->prefix('/transaksi')->group(function(){
    Route::post('/index/{id}', 'index')->name('transaksi.order');
    Route::post('/checkout', 'makeOrder');
    Route::get('/checkout/success', 'orderSuccess');
    Route::get('/checkout/fail', 'orderFail');
});

Route::controller(AdminController::class)->prefix('/admin')->group(function(){
    Route::get('/tambah', 'tambah')->name('admin.tambah');
    Route::get('/index', 'index');
    Route::get('/produk', 'lihatProduk')->name('admin.manage');
    Route::get('produk/variant/{id}', 'variantProduk')->name('admin.detailProduk');
    Route::post('/produk/variants/doEdit', 'doEdit');
    Route::get('/order/list', 'orderList')->name('admin.order');
    Route::get('/order/detail/{id}', 'orderDetail')->name('admin.detailOrder');
});

Route::get('/api/orderListByTanggal', [ApiController::class, 'urutkanDataByTanggal']);
Route::get('api/produk/variants/edit',[ProdukVariantApiController::class, 'editProdukVariant']);


Route::get('/payment/view', [PaymentController::class, 'index']);
Route::get('/tanggal',function(){
    echo now()->format('Y-m-d');
});

Route::get('/check', function(){
    return view('checkbox');
});
Route::post('/check', function(Request $request){
    dump($request->all());
});

Route::get('/gaada', function(){
    return view('index');
});

// Route::get('/cart/gaada',function(){
//     $carts = Cart::with(['variant.produk'])
//         ->where('pembeli_id', session('user_id'))
//         ->get();
//     return view('cart.nothing', compact('carts'));
// });