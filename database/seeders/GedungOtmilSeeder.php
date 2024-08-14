<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class GedungOtmilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gedung_otmil = [
            [
                'id' => 'ae802206-f286-4be2-94c5-cbcea9d31aa8',
                'nama_gedung_otmil' => 'Gedung OTMIL 1',
                'lokasi_otmil_id' => '890cc9b1-b01f-4d1f-9075-a6a96e851b25',
                'panjang' => 10,
                'lebar' => 10,
                'posisi_X' => 10,
                'posisi_Y' => 10,
                'created_at' => now()
            ]
        ];
        DB::table('gedung_otmil')->insert($gedung_otmil);
    }
}
