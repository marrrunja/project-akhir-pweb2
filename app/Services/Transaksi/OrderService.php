<?php  
namespace App\Services\Transaksi;
use Illuminate\Support\Facades\DB;

class OrderService
{

	public function hello():string
	{
		return "Hello order service";
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