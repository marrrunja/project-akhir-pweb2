<?php

namespace App\Http\Controllers\Transaksi;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Transaksi\Order;
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
}
