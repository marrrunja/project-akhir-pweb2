<?php  
namespace App\Services\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Produk\Stok;
class OrderService
{

	public function hello():string
	{
		return "Hello order service";
	}

	public function addOrder(array $data, ?string &$error = null, ?string &$linkBayar = null):bool
	{
        if(count($data) === 0){
        	$error = "Data tidak boleh kosong";
        	return false;
        }
        $isSuccess = false;
        $tanggalSekarang = now()->format('Y-m-d');

        $stok = Stok::where('variant_id', '=', $data['variantId'])->first();
        if($stok->jumlah === 0 || $stok->jumlah < $data['jumlah']){
        	$error = "Maaf stok tidak mencukupi sekarang";
        	return false;
        }
        DB::beginTransaction();
        try{
        	 DB::table('table_orders')->insert([
	        	'tanggal_transaksi' => $tanggalSekarang,
	        	'pembeli_id' => $data['userId'],
	        	'is_dibayar' => false,
	        	'total_harga' => $data['totalHarga'],
        	]);
	        $orderInsertId = DB::getPdo()->lastInsertId();
	        $orderId = 'INV-'.now()->format('Y-m-d') . '-' . $orderInsertId;
	        DB::table('order_items')->insert([
	        	'variant_id' => $data['variantId'],
	        	'order_id' =>  $orderInsertId,
	        	'jumlah' => $data['jumlah'],
	        	'total_harga' => $data['totalHarga']
	        ]);
	        $lastInsertOrderItemsId = DB::getPdo()->lastInsertId();
	        DB::statement("UPDATE stoks set jumlah = jumlah - ? WHERE variant_id = ?", [$data['jumlah'], $data['variantId']]);

         	$params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $data['totalHarga']
                ],
                'item_details' => [
                    [
                        'price' => $data['hargaSatuan'],
                        'quantity' => $data['jumlah'],
                        'name' => $orderId
                    ],
                ],
                'customer_details'=> [
                    'first_name' => $data['username'],
                    'email' => 'adillasnack@gmail.com'
                ],
                'enable_payments' => ['credit_card', 'bni_va', 'bca_va', 'gopay', 'alfamart', 'indomart']
            ];
            $url = 'https://app.sandbox.midtrans.com/snap/v1/transactions';

            $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Basic $auth"
            ])->post($url, $params);
            $response = json_decode($response->body());
            if(!isset($response->redirect_url)){
            	$error = $response;
            	// throw new \Exception('Gagal mendapatkan link pembayaran dari midtrans');
            	return false;
            }
            $linkBayar = $response->redirect_url;

            DB::table('table_orders')->where('id', '=', $orderInsertId)->update([
            	'order_id' => $orderId,
            	'link_bayar' => $response->redirect_url ?? null
            ]);
        	DB::commit();
        	$isSuccess = true;
        }catch(\Exception $e){
        	DB::rollback();
        	$error = $e->getMessage();
        	$isSuccess = false;
        }
        return $isSuccess;
	}

	public function addOrders(array $data, ?string &$error = null):bool
	{
		if(count($data) === 0) {
			$error = "Data tidak boleh kosong!!";
			return false;
		}
		$isSuccess = true;
		$userId = $data['userId'];
		$totalHarga = $data['totalHarga'];

		DB::beginTransaction();

		try{
			$carts = DB::table('carts')
			->join('produk_variants', 'carts.variant_id', '=', 'produk_variants.id')
			->select('produk_variants.harga', 'carts.*')
			->where('pembeli_id', '=', $userId)->get();

			DB::table('table_orders')->insert([
				'tanggal_transaksi' => now()->format('Y-m-d'),
				'pembeli_id' => $userId,
				'is_dibayar' => false,
				'total_harga' => $totalHarga
			]);
			$orderInsertId = DB::getPdo()->lastInsertId();
			$orderId = 'INV-' .now().'-'.$orderInsertId;
			DB::table('table_orders')->where('id', $orderInsertId)->update([
				'order_id' => $orderId
			]);

			foreach($carts as $cart){
				DB::table('order_items')->insert([
					'variant_id' => $cart->variant_id,
					'order_id' => $orderInsertId,
					'jumlah' => $cart->qty,
					'total_harga' => $cart->qty * $cart->harga
				]);
				$orderItemInsertId = DB::getPdo()->lastInsertId();
				DB::statement("UPDATE stoks set jumlah = jumlah - ? WHERE variant_id = ?", [$cart->qty, $orderItemInsertId]);
			}
			DB::table('carts')->where('pembeli_id', $userId)->delete();
			DB::commit();
			$isSuccess = true;
		}catch(\Exception $e){
			DB::rollback();
			$error = $e->getMessage();
			$isSuccess = false;
		}
		return $isSuccess;
	}
}