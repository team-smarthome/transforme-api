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
                'id' => Str::uuid()->toString(),
                'dmac' => "00:00:00:00:00:00",
                'nama_gateway' => "Gateway 1",
                'ruangan_otmil_id' => null,
                'ruangan_lemasmil_id' => "0c9ce687-12ce-435d-8f87-b519b7dd16b2",
                'wbp_profile_id' => "10cfa0a1-5ab3-4daa-9292-29397946316e",
                'is_permitted' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('akses_ruangan')->insert($aksesRuangan);
    }
}
