<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PintuAksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pintuAkses = [
            [
                'id' => '3d17185b-35c5-4eef-b06e-d8e868a0d758',
                'nama_pintu_akses' => 'Pintu Akses 1',
                'mac_address' => '00:00:00:00:00:00',
                'ruangan_otmil_id' => 'f6e62e45-498d-45a8-affd-e5e363c99442',
                'ruangan_lemasmil_id' => 'db10dd62-c048-44bb-a85e-9c2955170420',
                'status' => 'Aktif',
                'merk' => 'Merk 1',
                'model' => 'Model 1',
                'created_at' => now(),
            ]
        ];

        DB::table('pintu_akses')->insert($pintuAkses);
    }
}
