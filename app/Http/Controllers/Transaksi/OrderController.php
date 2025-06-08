<?php

namespace App\Http\Controllers\Transaksi;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Transaksi\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi\OrderItem;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request):Response
    {
        $orders = Order::where('pembeli_id', '=', $request->session()->get('user_id'))->get();
        $data = [
            'orders' => $orders
        ];
        return response()->view('transaksi.index', $data);
    }
    public function detailOrder(Request $request):Response
    {
        $items = DB::table('order_items')
        ->join('produk_variants', 'order_items.variant_id', 'produk_variants.id')
        ->join('products', 'produk_variants.produk_id', '=','products.id')
        ->select('order_items.id','products.nama', 'order_items.jumlah', 'order_items.jumlah','order_items.total_harga', 'produk_variants.harga', 'produk_variants.foto', 'produk_variants.variant')
        ->where('order_items.order_id', '=', $request->id)
        ->get();
        $data = [
            'items' => $items
        ];
        return response()->view('transaksi.order-items', $data);
    }

    public function deleteOrder():JsonResponse
    {
        $id = request('id');

        $order = Order::where('id', $id)->firstOrFail();
        $order->delete();
        return response()->json(['message' => "Berhasil hapus data"]);
    }
    public function cancel($orderId)
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;

        return \Midtrans\Transaction::cancel($orderId);
    }
}
