<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class GedungLemasMilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gedung_lemasmil = [
            [
                'id' => '70102b2a-fe4c-4d9b-88eb-57d6d2718c22',
                'nama_gedung_lemasmil' => 'Gedung OTMIL 1',
                'lokasi_lemasmil_id' => '48633be0-b005-4029-8bbb-293db9564ba0',
                'panjang' => 10,
                'lebar' => 10,
                'posisi_X' => 10,
                'posisi_Y' => 10,
                'created_at' => now()
            ]
        ];
        DB::table('gedung_lemasmil')->insert($gedung_lemasmil);
    }
}
