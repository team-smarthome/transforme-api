<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KameraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kamera = [
            [
                'id' => 'a30fcedb-a6a6-490d-bdef-31780b4ad016',
                'nama_kamera' => 'kamera 1',
                'url_rtsp' => 'rtsp://',
                'ip_address' => '19',
                'ruangan_otmil_id' => 'f6e62e45-498d-45a8-affd-e5e363c99442',
                'ruangan_lemasmil_id' => 'db10dd62-c048-44aa-a85e-9c29551704d2',
                'merk' => 'merk 1',
                'model' => 'model 1',
                'status_kamera' => 'Aktif',
                'created_at' => now(),
            ]
        ];

        DB::table('kamera')->insert($kamera);
    }
}
