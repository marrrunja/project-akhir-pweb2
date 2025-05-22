<?php

namespace Database\Seeders;

use App\Models\Produk\Stok;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'jumlah' => 1,
                'variant_id' => 3
            ],
              [
                'jumlah' => 1,
                'variant_id' => 2
            ],
              [
                'jumlah' => 1,
                'variant_id' => 1
            ],
              [
                'jumlah' => 1,
                'variant_id' => 1
            ],
              [
                'jumlah' => 1,
                'variant_id' => 2
            ],
        ];
        Stok::insert($data);
    }
}
