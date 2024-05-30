<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenBapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokumenBap = [
            [
                'id' => '9c2417c1-9bd2-496d-4102-8aec799aee90',
                'penyidikan_id' => '9c2909a4-82a3-4aee-ac85-f7316584212e',
                'nama_dokumen_bap' => 'bap',
                'link_dokumen_bap' => 'test',
                'wbp_profile_id' => '10cfa0a1-5ab3-4daa-9292-29397946316e',
                'saksi_id' => 'e0408528-fab5-443b-91f5-adcf2a420dcc',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('dokumen_bap')->insert($dokumenBap);
    }
}
