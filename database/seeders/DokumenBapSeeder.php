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
                'id' => '80e7e21a-4272-43ac-a8aa-d48a4c0ee835',
                'penyidikan_id' => 'd38bf884-b8b7-4ae4-a8da-ae7dab96d833',
                'nama_dokumen_bap' => 'Test',
                'link_dokumen_bap' => 'Test',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'saksi_id' => 'e0408528-fab5-443b-91f5-adcf2a420dcc',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '80e7e21a-4272-43ac-a1aa-d48a4c0ee835',
                'penyidikan_id' => 'd38bf884-b8b7-4ae4-a8da-ae7dab96d833',
                'nama_dokumen_bap' => 'Test',
                'link_dokumen_bap' => 'Test',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'saksi_id' => 'e0408528-fab5-443b-91f5-adcf2a420dcc',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '80e7e21a-4272-43ac-a2aa-d48a4c0ee835',
                'penyidikan_id' => 'd38bf884-b8b7-4ae4-a8da-ae7dab96d833',
                'nama_dokumen_bap' => 'Test',
                'link_dokumen_bap' => 'Test',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'saksi_id' => 'e0408528-fab5-443b-91f5-adcf2a420dcc',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '80e7e21a-4272-43ac-a3aa-d48a4c0ee835',
                'penyidikan_id' => 'd38bf884-b8b7-4ae4-a8da-ae7dab96d833',
                'nama_dokumen_bap' => 'Test',
                'link_dokumen_bap' => 'Test',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'saksi_id' => 'e0408528-fab5-443b-91f5-adcf2a420dcc',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '80e7e21a-4272-43ac-a4aa-d48a4c0ee835',
                'penyidikan_id' => 'd38bf884-b8b7-4ae4-a8da-ae7dab96d833',
                'nama_dokumen_bap' => 'Test',
                'link_dokumen_bap' => 'Test',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'saksi_id' => 'e0408528-fab5-443b-91f5-adcf2a420dcc',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '80e7e21a-4272-43ac-a5aa-d48a4c0ee835',
                'penyidikan_id' => 'd38bf884-b8b7-4ae4-a8da-ae7dab96d833',
                'nama_dokumen_bap' => 'Test',
                'link_dokumen_bap' => 'Test',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'saksi_id' => 'e0408528-fab5-443b-91f5-adcf2a420dcc',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('dokumen_bap')->insert($dokumenBap);
    }
}
