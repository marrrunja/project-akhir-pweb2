<?php  

namespace App\Services\Transaksi;
use Illuminate\Support\Facades\DB;
class OrderService
{
	private OrderItemService $orderItem;

	public function __construct(OrderItemService $orderItem)
	{
		$this->orderItem = $orderItem;
	}
	public function hello():string
	{
		return "Hello order service";
	}
	public function addOrder($tanggal, $idPembeli)
	{
		DB::beginTransaction();
		try{
			
			DB::commit();
			return true;
		}catch(\Exception $e){
			DB::rollback();
		}
	}
}