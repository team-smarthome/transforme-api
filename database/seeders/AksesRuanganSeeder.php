<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AksesRuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aksesRuangan = [
            [
                'id' => 'd2eaf770-02a6-4ae7-b216-a2ede0b3652f',
                'dmac' => '00:0a:95:9d:68:16',
                'nama_gateway' => 'Gateway 1',
                'ruangan_otmil_id' => 'f6e62e45-498d-45a8-affd-e5e363c99442',
                'ruangan_lemasmil_id' => 'db10dd62-c048-44bb-a85e-9c2955170420',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'is_permitted' => 1,
                'created_at' => now(),
            ]
        ];

        DB::table('akses_ruangan')->insert($aksesRuangan);
    }
}
