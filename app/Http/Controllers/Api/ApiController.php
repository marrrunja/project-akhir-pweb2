<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function urutkanDataByTanggal(Request $request):Response
    {
        $orders = DB::table('pembelis')
                    ->join('table_orders', 'pembelis.id','=','table_orders.pembeli_id')
                    ->select('pembelis.username', 'table_orders.tanggal_transaksi', 'table_orders.is_dibayar', 'table_orders.id');

        $order = null;
        
        if($request->order == "2") $order = "ASC";
        else if($request->order == "0") $order = "DESC";
        else
            $order = "ASC";

        $data = [
            'pesan' => 'berhasil',
            'order' => $order,
            'orders' => $orders->orderBy("table_orders.tanggal_transaksi", $order)->get()
        ];
        return response()->view('partial.tableOrder', $data)->render();
    }
}
