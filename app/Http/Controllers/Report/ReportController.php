<?php

namespace App\Http\Controllers\Report;

use Mpdf\Mpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function createReport()
    {
        $orders = DB::table('pembelis')
        ->join('table_orders', 'pembelis.id', '=', 'table_orders.pembeli_id')
        ->select('pembelis.username', 'table_orders.tanggal_transaksi', 'table_orders.is_dibayar', 'table_orders.id','table_orders.total_harga')
        ->orderBy('table_orders.id', 'DESC')
        ->get();
        $pdf = new Mpdf();
        $data = [
            'orders' => $orders
        ];
        $pdf->writeHTML(view('laporan.laporan-penjualan',$data));
        $pdf->Output('laporan-penjualan.pdf','I');
    }
    
    public function createReportDetail(Request $request){
        $id = $request->id;
        $orderItems = DB::table('table_orders')
            ->join('order_items', 'table_orders.id', '=', 'order_items.order_id')
            ->join('produk_variants', 'order_items.variant_id', '=', 'produk_variants.id')
            ->join('products', 'produk_variants.produk_id', '=', 'products.id')
            ->select('table_orders.tanggal_transaksi', 'order_items.jumlah', 'order_items.total_harga', 'produk_variants.variant', 'products.nama', 'produk_variants.harga', 'produk_variants.foto')
            ->where('order_items.order_id', '=', $id)
            ->get();
     
        $pdf = new Mpdf();
        $data = [
            'details' => $orderItems
        ];
        $pdf->writeHTML(view('laporan.detail-laporan-penjualan',$data));
        $pdf->Output('detail-penjualan.pdf','I');
    }
}
