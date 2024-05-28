<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class LantaiLemasMilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lantai_lemasmil = [
            [
                'id' => "4ee351b2-be3f-46bf-9fee-059c792ed574",
                'nama_lantai' => 'lantai_lemasmil_1',
                'panjang' => 10,
                'lebar' => 10,
                'posisi_X' => 10,
                'posisi_Y' => 10,
                'lokasi_lemasmil_id' => '48633be0-b005-4029-8bbb-293db9564ba0',
                'gedung_lemasmil_id' => '70102b2a-fe4c-4d9b-88eb-57d6d2718c22',
                'created_at' => now()
            ]
            ];
        DB::table('lantai_lemasmil')->insert($lantai_lemasmil);
    }
}
