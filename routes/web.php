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
use App\Http\Controllers\Produk\ProdukVariantController;

Route::get('/', [UserController::class, 'index']);

Route::controller(LoginController::class)->prefix('/login')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasMiddleware::class);
    Route::post('/index/post', 'doLogin');
    Route::post('/logout', 'logout');
});


Route::controller(RegisterController::class)->prefix('/register')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasMiddleware::class);
    Route::post('/index', 'doRegister');
});

// cart
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'cart'])->middleware(SessionHasNotMiddleware::class)->name('cart.index');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/delete', [CartController::class, 'destroy'])->name('cart.delete');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');


// produk 
Route::controller(ProdukController::class)->prefix('/produk')->group(function(){
    Route::get('/index', 'index')->middleware(SessionHasNotMiddleware::class);
    Route::post('/add', 'addProduk')->name('produk.tambah');
    Route::get('/edit/{id}', 'editProduk')->name('produk.edit');
    Route::post('edit/{id}', 'doEdit')->name('produk.doEdit');
    Route::get('/search', 'searchOnlyProduk');
});

// produk variant
Route::post('/variant/search', [ProdukVariantController::class, 'search'])->middleware(SessionHasNotMiddleware::class);

Route::get('/variant/{id}', [ProdukVariantController::class, 'produkVariant'])->middleware(SessionHasNotMiddleware::class)->name('produk.variant');

Route::post('/variant/tambah/{id}', [ProdukVariantController::class,'addProdukVariant']);
Route::post('/variant/doEdit', [ProdukVariantController::class, 'doEdit']);

// transaksi
Route::controller(TransaksiController::class)->prefix('/transaksi')->group(function(){
    Route::post('/index/{id}', 'index')->name('transaksi.order');
    Route::post('/checkout', 'makeOrder');
    Route::get('/checkout/success', 'orderSuccess');
    Route::get('/checkout/fail', 'orderFail');
});

// controller admin
Route::controller(AdminController::class)->prefix('/admin')->group(function(){
    Route::get('/tambah', 'tambah')->name('admin.tambah');
    Route::get('/index', 'index');
    Route::get('/produk', 'lihatProduk')->name('admin.manage');
    Route::get('produk/variant/{id}', 'variantProduk')->name('admin.detailProduk');
    Route::get('/order/list', 'orderList')->name('admin.order');
    Route::get('/order/detail/{id}', 'orderDetail')->name('admin.detailOrder');
});

// route untuk api
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