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
            ['id' => Str::uuid(), 'nama_kesatuan' => 'Kesatuan Jakarta', 'lokasi_kesatuan_id' => "a9227b10-31e2-49f5-8131-6ebddfe54f5d", 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('kesatuan')->insert($kesatuan);
    }
}
