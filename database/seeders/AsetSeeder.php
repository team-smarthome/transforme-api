<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aset = [
            [
                'id' => '796ed53d-dc0f-4498-8aaa-35a66d011652',
                'nama_aset' => 'Mobil',
                'tipe_aset_id' => '7911d5aa-1f81-4329-982c-0c290077846d',
                'ruangan_otmil_id' => 'f6e62e45-498d-45a8-affd-e5e363c99442',
                'ruangan_lemasmil_id' => 'db10dd62-c048-44bb-a85e-9c2955170420',
                'kondisi' => 'Baik',
                'keterangan' => 'Mobil Dinas',
                'tanggal_masuk' => now(),
                'serial_number' => '1234567890',
                'model' => 'Mobil',
                'image' => 'image.jpg',
                'merek' => 'Toyota',
                'garansi' => '1999-01-01',
                'created_at' => now(),
            ]
        ];
        DB::table('aset')->insert($aset);
    }
}
