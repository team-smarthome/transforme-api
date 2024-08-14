<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class LokasiKesatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lokasi_kesatuan = [
            ['id' => 'd54069af-78d0-49fa-aaa4-6e53819eb13a', 'nama_lokasi_kesatuan' => 'Jakarta', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('lokasi_kesatuan')->insert($lokasi_kesatuan);
    }
}
