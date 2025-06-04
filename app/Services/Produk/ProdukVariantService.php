<?php 

namespace App\Services\Produk;

class ProdukVariantService
{
	public function add(array $data, ?string &$error)
	{
		if(count($data) === 0){
			$error = "Data tidak boleh kosong";
			return false;	
		}
	}
}