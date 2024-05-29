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
                'penyidikan_id' => 'c48bf881-b8b7-4ae4-a8da-ae7dab96d832',
                'nama_dokumen_bap' => 'bap',
                'link_dokumen_bap' => 'test',
                'wbp_profile_id' => '10cfa0a1-5ab3-4daa-9292-29397946316e',
                'saksi_id' => '9c26a422-4c20-43b7-8b68-fee5525af837',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('dokumen_bap')->insert($dokumenBap);
    }
}
