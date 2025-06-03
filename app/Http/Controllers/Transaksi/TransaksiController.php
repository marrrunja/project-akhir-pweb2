<?php

namespace App\Http\Controllers\Transaksi;

use App\Models\Cart;
use App\Models\Produk\Stok;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Transaksi\Order;
use Illuminate\Http\JsonResponse;
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
    
    public function index(Request $request,$id):Response|RedirectResponse
    {
        $validate = [
            'jumlah' => ['integer','required', 'min:1'],
        ];
        $pesanValidasi = [
            'jumlah.integer' => 'Input jumlah harus bertipe angka!',
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
    public function makeOrder(Request $request):JsonResponse
    {
        $userId = (int)$request->session()->get('user_id');
        $username = $request->session()->get('username');
        $jumlah = (int)$request->jumlah;
        $hargaSatuan = (int)$request->harga;
        $totalHarga = (int)$request->totalHarga;
        $variantId = (int)$request->id;

        // masukkan semua variabel ke dalam array data
        $data = [
            'userId' => $userId,
            'jumlah' => $jumlah,
            'hargaSatuan' =>  $hargaSatuan,
            'totalHarga' => $totalHarga,
            'variantId' => $variantId,
            'username' => $username
        ];
        $error = null;
        $linkBayar = null;

        // gunakan dependency injection order service
        if($this->orderService->addOrder($data, $error, $linkBayar)){
            $data = [
                'status' => 'berhasil',
                'redirect_url' => $linkBayar
            ];
            return response()->json($data);
        }else{
            return response()->json([
                'pesan' => $error,
                'status' => 'gagal',
            ]);
        }
        
        return response()->json([
            'pesan' => 'Internal server error'
        ], 500);
    }

    public function makeOrders(Request $request)
    {
        $userId = $request->userId;
        $totalHarga = $request->totalHarga;
        $data = [
            'userId' => $userId,
            'totalHarga' => $totalHarga
        ];
        $error = null;
       if($this->orderService->addOrders($data, $error)){
        return redirect('/cart')->with('status', 'order berhasil');
       }else{
        return redirect('/cart')->with('status', $error);
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
