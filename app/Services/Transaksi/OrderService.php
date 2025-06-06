<?php
  
namespace App\Services\Transaksi;
use Carbon\Carbon;
use App\Models\Pembeli;
use App\Models\Produk\Stok;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Produk\ProdukVariant;
use Illuminate\Support\Facades\Http;

class OrderService
{

	private function insertIntoOrderTable($tanggal, $pembeliId, $totalHarga, ?int &$orderInsertId = null, ?string &$orderId = null):void
	{
		DB::table('table_orders')->insert([
        	'tanggal_transaksi' => $tanggal,
        	'pembeli_id' => $pembeliId,
        	'is_dibayar' => false,
        	'total_harga' => $totalHarga,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now()
        ]);
        $orderInsertId = DB::getPdo()->lastInsertId();
        $orderId = 'INV-'.now()->format('Y-m-d') . '-' . $orderInsertId;
	}

	private function insertIntoOrderItems(Collection $carts, $orderInsertId):void
	{
		foreach($carts as $cart){
			DB::table('order_items')->insert([
				'variant_id' => $cart->variant_id,
				'order_id' => $orderInsertId,
				'jumlah' => $cart->qty,
				'total_harga' => $cart->qty * $cart->harga,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			]);
		}
	}

	private function initMidtrans(array|Collection $data,$username,$totalHarga, $orderId):array
	{
		$pembeli = Pembeli::where('username', '=',$username)->first();
		$items = [];
		if(count($data) == 1){
			foreach($data as $value){
				$items[] = [
					'price' => $value['hargaSatuan'],
					'quantity' => $value['jumlah'],
					'name' => $orderId
				];
			}
		}else{
			foreach($data as $row){
				$variant = ProdukVariant::where('id', '=', $row->variant_id)->first();
				$items[] = [
					'price' => $variant->harga,
					'quantity' => $row->qty,
					'name' => $orderId
 				];
			}
		}
		$params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalHarga
            ],
            'item_details' => $items,
            'customer_details'=> [
                'first_name' => $username,
                'email' => $pembeli->email
            ],
            'enable_payments' => ['credit_card', 'bni_va', 'bca_va', 'gopay', 'alfamart', 'indomart'],
            'callbacks' => [
		        'finish' => url('/transaksi/finish'),// Ganti sesuai dengan URL kamu
			],
        ];
        $url = 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Basic $auth"
        ])->post($url, $params);
        $response = json_decode($response->body(), true);

        return $response;
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
		if(!$stok){
			$error = 'Variant tidak ditemukan';
			return false;
		}
        if($stok->jumlah === 0 || $stok->jumlah < $data['jumlah']){
        	$error = "Maaf stok tidak mencukupi sekarang";
        	return false;
        }
        DB::beginTransaction();
        try{
        	$orderInsertId = null;
        	$orderId = null;
        	$this->insertIntoOrderTable($tanggalSekarang, $data['userId'], $data['totalHarga'], $orderInsertId, $orderId);

	        DB::table('order_items')->insert([
	        	'variant_id' => $data['variantId'],
	        	'order_id' =>  $orderInsertId,
	        	'jumlah' => $data['jumlah'],
	        	'total_harga' => $data['totalHarga'],
	        	'created_at' => Carbon::now(),
	        	'updated_at' => Carbon::now()
	        ]);
	        $lastInsertOrderItemsId = DB::getPdo()->lastInsertId();
			// stok baru di update, saat user menyelesaikan pembayaran
	        // DB::statement("UPDATE stoks set jumlah = jumlah - ? WHERE variant_id = ?", [$data['jumlah'], $data['variantId']]);
			$items = [
				[
					'hargaSatuan' => $data['hargaSatuan'],
					'jumlah' => $data['jumlah']
				]	
			];
            $response = $this->initMidtrans($items,$data['username'], $data['totalHarga'] ,$orderId);
            if (!isset($response['redirect_url'])) {
			    DB::rollback();
			    $error = $response['status_message'] ?? 'Gagal membuat transaksi Midtrans';
			    return false;
			}
            $linkBayar = $response['redirect_url'];

            DB::table('table_orders')->where('id', '=', $orderInsertId)->update([
            	'order_id' => $orderId,
            	'link_bayar' => $response['redirect_url'] ?? null
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
		$isSuccess = false;
		$userId = $data['userId'];
		$totalHarga = $data['totalHarga'];
		$username = $data['username'];

		DB::beginTransaction();

		try{
			$carts = DB::table('carts')
			->join('produk_variants', 'carts.variant_id', '=', 'produk_variants.id')
			->select('produk_variants.harga', 'carts.*')
			->where('pembeli_id', '=', $userId)->get();

			if(count($carts) === 0){
				$error = 'Cart masih kosong';
				return false;
			}

			$orderInsertId = null;
        	$orderId = null;
        	$tanggalSekarang = now()->format('Y-m-d');

        	$this->insertIntoOrderTable($tanggalSekarang, $data['userId'], $data['totalHarga'], $orderInsertId, $orderId);
			DB::table('table_orders')->where('id', $orderInsertId)->update([
				'order_id' => $orderId
			]);
			
			$this->insertIntoOrderItems($carts, $orderInsertId);
			$response = $this->initMidtrans($carts, $username, $totalHarga, $orderId);

			if (!isset($response['redirect_url'])) {
			    DB::rollback();
			    $error = $response['status_message'] ?? 'Gagal membuat transaksi Midtrans';
			    return false;
			}
            $linkBayar = $response['redirect_url'];
            DB::table('table_orders')->where('id', '=', $orderInsertId)->update([
            	'order_id' => $orderId,
            	'link_bayar' => $response['redirect_url'] ?? null
            ]);

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