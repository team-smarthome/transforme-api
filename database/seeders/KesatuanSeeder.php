<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class KesatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kesatuan = [
            ['id' => "18ff69b7-3d9f-4a60-a602-5baf4f3cc081", 'nama_kesatuan' => 'Kesatuan Jakarta', 'lokasi_kesatuan_id' => "d54069af-78d0-49fa-aaa4-6e53819eb13a", 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('kesatuan')->insert($kesatuan);
    }
}
