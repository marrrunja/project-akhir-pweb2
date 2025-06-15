<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Transaksi\OrderController;
use App\Http\Controllers\Transaksi\TransaksiController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/webhook/midtrans', [TransaksiController::class, 'webhook']);
Route::post('/order/hapus', [OrderController::class,'deleteOrder']);
Route::post('/riwayat/delete',[OrderController::class, 'deleteHistory']);