<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'pembeli_id' => 1,
                'variant_id' => 29,
                'qty' => 2
            ],
            [
                'pembeli_id' => 1,
                'variant_id' => 33,
                'qty' => 2
            ],
            [
                'pembeli_id' => 1,
                'variant_id' => 38,
                'qty' => 2
            ]
        ];
        Cart::insert($data);
    }
}
