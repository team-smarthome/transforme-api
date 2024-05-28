<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GelangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gelang = [
            [
                'id' => "6ced89b4-f889-489d-a777-a1487c392901",
                'dmac' => "123456",
                'nama_gelang' => "Gelang Merah",
                'tanggal_pasang' => now(),
                'tanggal_aktivasi' => now(),
                'ruangan_otmil_id' => 'f6e62e45-498d-45a8-affd-e5e363c99442',
                'ruangan_lemasmil_id' => 'db10dd62-c048-44aa-a85e-9c29551704d2',
                'baterai' => "123456",
                'created_at' => now()
            ]
        ];
        DB::table('gelang')->insert($gelang);
    }
}
