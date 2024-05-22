<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kota = [
            ['id' => Str::uuid(), 'nama_kota' => 'Jakarta Selatan', 'provinsi_id' => '15585b43-f9fc-428a-b5b8-1e414183a8f8', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('kota')->insert($kota);
    }
}
