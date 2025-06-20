<?php

namespace App\Http\Controllers\Transaksi;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Transaksi\Order;
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
    public function __construct(OrderService $orderService)
    {
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
            Log::info("User dengan id $userId berhasil melakukan pemesanan");
            $data = [
                'status' => 'berhasil',
                'redirect_url' => $linkBayar
            ];
            return response()->json($data, 200);
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
    public function makeOrders(Request $request):JsonResponse
    {
        $userId = $request->userId;
        $totalHarga = $request->totalHarga;
        $username = $request->session()->get('username');
        $data = [
            'userId' => $userId,
            'totalHarga' => $totalHarga,
            'username' => $username
        ];
        $error = null;
        $link = null;
       if($this->orderService->addOrders($data, $error, $link)){
        Log::info("User dengan user id $userId berhasil order pesanan dari cart");
        return response()->json(['message' => 'Berhasil order', 'redirect_url' => $link]);
       }else{
        return response()->json(['message' => 'Gagal order' . $error],422);
       }
    }

    private function initWebhook($orderId)
    {
        $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));
        $midtransResponse = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Basic $auth"
            ])->get("https://api.sandbox.midtrans.com/v2/$orderId/status");
        $response = json_decode($midtransResponse->body());
        return $response;
    }
    public function webhook(Request $request):JsonResponse
    {
        Log::info("Webhook dari midtrans");
        $response = $this->initWebhook($request->order_id);
        if ($response->transaction_status === 'settlement') {
            DB::beginTransaction();
            try{
                // update is dibayar menjadi satu ketika pembayaran sudah lunas
                DB::statement("UPDATE table_orders SET is_dibayar = ? WHERE order_id = ?", [1, $response->order_id]);
                $variantIds = DB::table('order_items')
                    ->join('table_orders', 'order_items.order_id', '=', 'table_orders.id')
                    ->where('table_orders.order_id','=',$response->order_id)
                    ->pluck('order_items.variant_id');

                // lock update nya untuk mencegah race condition
                DB::table('stoks')
                    ->whereIn('variant_id', $variantIds)
                    ->lockForUpdate()
                    ->get();

                $query = "UPDATE stoks
                        JOIN order_items ON stoks.variant_id = order_items.variant_id
                        JOIN table_orders ON order_items.order_id = table_orders.id
                        SET stoks.jumlah = stoks.jumlah - order_items.jumlah
                        WHERE table_orders.order_id = ? AND stoks.jumlah >= order_items.jumlah
                        ";
                $update = DB::update($query, [$response->order_id]);
                if($update <= 0) {
                    DB::rollback();
                    Log::info("Order id $response->order_id, gagal melakukan pembelian karna order id tidak valid atau stok tidak mencukupi");
                    return response()->json(['message' => 'Gagal melakukan chechkout karna order id atau stok tidak mencukupi'], 422);
                }
                DB::commit();
                Log::info("Berhasil update produk dengan order id $response->order_id");
                return response()->json(['message' => 'Berhasil melakukan order ' . $response->order_id],200);
            }catch(\Exception $e){
                DB::rollback();
                return response()->json(['message' => 'Pembelian gagal' . $e->getMessage()],422);
            }
        }
        return response()->json(['message' => 'Webhook processed']);
    }

    public function success(Request $request){
        $orderId = $request->order_id;
        $order = Order::where('order_id', $orderId)->first();

        if($order){
            if($order->is_dibayar != 1){
                try{
                    // update is dibayar menjadi satu ketika pembayaran sudah lunas
                    DB::statement("UPDATE table_orders SET is_dibayar = ? WHERE order_id = ?", [1, $orderId]);
                    $variantIds = DB::table('order_items')
                        ->join('table_orders', 'order_items.order_id', '=', 'table_orders.id')
                        ->where('table_orders.order_id','=',$orderId)
                        ->pluck('order_items.variant_id');

                    // lock update nya untuk mencegah race condition
                    DB::table('stoks')
                        ->whereIn('variant_id', $variantIds)
                        ->lockForUpdate()
                        ->get();
    
                    $query = "UPDATE stoks
                            JOIN order_items ON stoks.variant_id = order_items.variant_id
                            JOIN table_orders ON order_items.order_id = table_orders.id
                            SET stoks.jumlah = stoks.jumlah - order_items.jumlah
                            WHERE table_orders.order_id = ? AND stoks.jumlah >= order_items.jumlah
                            ";
                    $update = DB::update($query, [$orderId]);
                    if($update <= 0) {
                        DB::rollback();
                        Log::info("Order id $orderId, gagal melakukan pembelian karna order id tidak valid atau stok tidak mencukupi");
                    }
                    DB::commit();
                    Log::info("Berhasil update produk dengan order id $orderId");
                }catch(\Exception $e){
                    DB::rollback();
                }
            }
        }
        return view('transaksi.order-success');
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
