<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori' => 'Makanan'
            ],
            [
                'kategori' => 'Minuman'
            ],
            [
                'kategori' => 'Souvenir'
            ],
        ];
        Kategori::insert($data);
    }
}
