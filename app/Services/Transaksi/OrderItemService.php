<?php 


namespace App\Services\Transaksi;
use App\Services\Transaksi\OrderService;
class OrderItemService
{
	private OrderService $orderService;
	public function __construct(OrderService $orderService)
	{
		$this->orderService = $orderService;
	}
}