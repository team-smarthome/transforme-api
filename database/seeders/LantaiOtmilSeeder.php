<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class LantaiOtmilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lantai_otmil = [
            [
                'id' => "75ce4e82-e167-4c01-a570-fe392811155d",
                'nama_lantai' => 'lantai_otmil_1',
                'panjang' => 10,
                'lebar' => 10,
                'posisi_X' => 10,
                'posisi_Y' => 10,
                'lokasi_otmil_id' => '890cc9b1-b01f-4d1f-9075-a6a96e851b25',
                'gedung_otmil_id' => 'ae802206-f286-4be2-94c5-cbcea9d31aa8',
                'created_at' => now()
            ]
            ];
        DB::table('lantai_otmil')->insert($lantai_otmil);
    }
}
