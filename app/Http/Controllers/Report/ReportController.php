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
        ->select('pembelis.username', 'table_orders.tanggal_transaksi', 'table_orders.is_dibayar', 'table_orders.id')
        ->get();
        $pdf = new Mpdf();
        $data = [
            'orders' => $orders
        ];
        $pdf->writeHTML(view('laporan.laporan-penjualan',$data));
        $pdf->Output();
    }
    public function createReportDetail(Request $request){
        $pdf = new Mpdf();
        $pdf->writeHTML(view('laporan.detail-laporan-penjualan',$data));
        $pdf->Output();
    }
}
