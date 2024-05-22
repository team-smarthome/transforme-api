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
            ['id' => Str::uuid(), 'nama_kesatuan' => 'Udin', 'lokasi_kesatuan_id' => "01ca1139-38be-48a5-84f0-45cad2eb7e86", 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('kesatuan')->insert($kesatuan);
    }
}
