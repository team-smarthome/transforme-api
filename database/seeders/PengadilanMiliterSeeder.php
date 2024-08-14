<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class PengadilanMiliterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     $pengadilanMiliter  = [
        [
            'id' => '39ee0d88-9ea7-489a-8a8a-6828c51a58ce',
            'nama_pengadilan_militer' => 'Pengadilan Militer I-01 Jakarta',
            'provinsi_id' => 'a00fa162-5cd1-475e-ad81-03426a7f7952',
            'kota_id' => '847b7af8-f2cc-4b62-96a0-22cc3d1b2511',
            'latitude' => '-6.229728',
            'longitude' => '106.689431',
            'created_at' => now()
        ]
     ];   
     DB::table('pengadilan_militer')->insert($pengadilanMiliter);
    }
}
