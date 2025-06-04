<?php

namespace App\Http\Controllers\Transaksi;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Produk\ProdukVariant;
use Illuminate\Support\Facades\Http;
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
        $validate = [
            'jumlah' => 'required',
            'harga' => 'required',
            'totalHarga' => 'required',
            'id' => 'required'
        ];
        $request->validate($validate);
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
            ], 422);
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

    public function webhook(Request $request)
    {
        Log::info("Webhook dari midtrans");
        $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));
        $midtransResponse = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Basic $auth"
        ])->get("https://api.sandbox.midtrans.com/v2/$request->order_id/status");

        $response = json_decode($midtransResponse->body());
        if ($response->transaction_status === 'settlement') {
            DB::statement("UPDATE table_orders SET is_dibayar = ? WHERE order_id = ?", [1, $response->order_id]);
            Log::info("Berhasil update produk dengan order id $response->order_id");
        }
        return response()->json(['message' => 'Webhook processed']);
    }

    public function success(Request $request):Response{
        return "Order sukses";
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
