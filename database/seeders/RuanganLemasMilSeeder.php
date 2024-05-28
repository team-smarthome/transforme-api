<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class RuanganLemasMilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruangan_lemasmil = [
            [
                'id' => "db10dd62-c048-44aa-a85e-9c29551704d2",
                'nama_ruangan_lemasmil' => 'ruangan_lemasmil_1',
                'jenis_ruangan_lemasmil' => 'jenis_ruangan_lemasmil_1',
                'lokasi_lemasmil_id' => '48633be0-b005-4029-8bbb-293db9564ba0',
                'zona_id' => 'e6884cad-d514-4db3-b4cc-5ab2465c6b99',
                'panjang' => 10,
                'lebar' => 10,
                'posisi_X' => 10,
                'posisi_Y' => 10,
                'lantai_lemasmil_id' => '4ee351b2-be3f-46bf-9fee-059c792ed574',
                'created_at' => now()
            ]
            ];
        DB::table('ruangan_lemasmil')->insert($ruangan_lemasmil);
    }
}
