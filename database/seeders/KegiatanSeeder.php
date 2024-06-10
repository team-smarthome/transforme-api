<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kegiatan = [
            [
                'id' => "9c3275c0-de26-43d6-9e33-1be904x0eba1",
                'nama_kegiatan' => 'Kegiatan 1',
                'ruangan_otmil_id' => 'f6e62e45-498d-45a8-affd-e5e363c99442',
                'ruangan_lemasmil_id' => null,
                'status_kegiatan' => 'apa aja',
                'waktu_mulai_kegiatan' => now(),
                'waktu_selesai_kegiatan' => now(),
                'zona_waktu' => 'WIB',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('kegiatan')->insert($kegiatan);
    }
}
