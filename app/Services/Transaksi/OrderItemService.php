<?php 

namespace App\Services\Transaksi;
use App\Services\Transaksi\OrderService;
use Illuminate\Support\Facades\DB;
class OrderItemService
{
	public function addOrderItem(array $data)
	{
		if($data == []){
			return false;
			$id = DB::getPdo()->lastInsertId();
		}else {
			// DB::beginTransaction();
			try{
				foreach($data as $row){
					$dataInsert = [
						'variant_id' => $row["variant_id"],
						'order_id' => $row["order_id"],
						'jumlah' => $row["jumlah"],
						'total_harga' => $row["jumlah"] * $row["harga_satuan"]
					];
				}
					return true;
				DB::commit();

			}catch(\Exception $e){
				DB::rollback();
				dump($e->getMessage());
			}

		}
	}
}