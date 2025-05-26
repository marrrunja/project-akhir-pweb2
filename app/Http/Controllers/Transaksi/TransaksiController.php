<?php

namespace App\Http\Controllers\Transaksi;

use App\Models\Produk\Stok;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Transaksi\Order;
use App\Models\Transaksi\OrderItem;
use App\Http\Controllers\Controller;
use App\Models\Produk\ProdukVariant;
use Illuminate\Http\RedirectResponse;
use App\Services\Transaksi\OrderService;

class TransaksiController extends Controller
{
    private OrderService $orderService;
    public function __construct(OrderService $orderService){
        $this->orderService = $orderService;
    }
    public function addTransaction()
    {
        
    }
    public function index(Request $request,$id):Response|RedirectResponse
    {
        $validate = [
            'jumlah' => ['integer','required', 'min:1'],
        ];
        $pesanValidasi = [
            'jumlah.number' => 'Input jumlah harus bertipe angka!',
            'jumlah.required' => 'Inputan jumlah harus diisi!!',
            'jumlah.min' => 'Jumlah pesanan minimal 1!!'
        ];
        $request->validate($validate, $pesanValidasi);
        $jumlah = $request->jumlah;
        $userId = $request->session()->get('user_id');
        $produkVariant = ProdukVariant::where('id', '=', $id)->first();

        if($produkVariant){

            $data = [
                'jumlah' => $jumlah,
                'produkVariant' => $produkVariant,
                'total' => $produkVariant->harga * $jumlah
            ];
            return response()->view('transaksi.order-detail', $data);
        }
        else{
            return redirect()->back();
        }
    }
    public function makeOrder(Request $request)
    {
        
        $userId = $request->session()->get('user_id');
        $jumlah = $request->jumlah;
        $totalHarga = $request->totalHarga;
        $variantId = $request->id;
        $tanggalSekarang = now()->format("Y-m-d");
        $response = [];
        $stok = Stok::where('variant_id', '=', $variantId)->firstOrFail();
        
        if($stok->jumlah === 0 || $jumlah > $stok->jumlah){
            $response = [
                "pesan" => "Stok belum mencukupi, silahkan kembali lagi ketika re stok",
                'status' => 'gagal'
            ];
            echo json_encode($response);
        }else{
            // buat order baru
            $order = new Order();
            $order->tanggal_transaksi = $tanggalSekarang;
            $order->pembeli_id = $userId;
            $order->save();

            // generate id untuk order item, dengan last id insert pada order
            $orderInsertId = $order->id;

            // buat order item baru
            $orderItem = new OrderItem();
            $orderItem->variant_id = $variantId;
            $orderItem->order_id = $orderInsertId;
            $orderItem->jumlah = $jumlah;
            $orderItem->total_harga = $totalHarga;
            $orderItem->save();


            // update stok pada table stok
            $jumlahStokFromDB = $stok->jumlah;
            $jumlahInsertDB = $jumlahStokFromDB - $jumlah;
            Stok::where('variant_id', '=',$variantId)->update(['jumlah' => $jumlahInsertDB]);

            $response = [
                'pesan' => "Berhasil",
                'status' => 'berhasil'
            ];
            echo json_encode($response);
        }
    }
    public function orderSuccess():RedirectResponse
    {
        return redirect('/produk/index')->with('status', 'Berhasil order!!');
    }
    public function orderFail(Request $request):RedirectResponse
    {
        $pesan = $request->pesan;
        return redirect('/produk/index')->with('status', 'Gagal memesan, ' . $pesan);
    }
}
