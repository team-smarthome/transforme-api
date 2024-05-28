<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RuanganOtmilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruangan_otmil = [
            [
                'id' => "f6e62e45-498d-45a8-affd-e5e363c99442",
                'nama_ruangan_otmil' => 'ruangan_otmil_1',
                'jenis_ruangan_otmil' => 'jenis_ruangan_otmil_1',
                'lokasi_otmil_id' => '890cc9b1-b01f-4d1f-9075-a6a96e851b25',
                'zona_id' => 'e6884cad-d514-4db3-b4cc-5ab2465c6b99',
                'panjang' => 10,
                'lebar' => 10,
                'posisi_X' => 10,
                'posisi_Y' => 10,
                'lantai_otmil_id' => '75ce4e82-e167-4c01-a570-fe392811155d',
                'created_at' => now()
            ]
            ];
        DB::table('ruangan_otmil')->insert($ruangan_otmil);
    }
}
