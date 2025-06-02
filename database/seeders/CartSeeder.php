<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'variant_id' => 3,
                'qty' => 1
            ],
            $data = [            
                'pembeli_id' => 1,
                'variant_id' => 5,
                'qty' => 1
            ],
            $data = [            
                'pembeli_id' => 1,
                'variant_id' => 6,
                'qty' => 1
            ]    
            ];
            Cart:insert($data);
    }
}
