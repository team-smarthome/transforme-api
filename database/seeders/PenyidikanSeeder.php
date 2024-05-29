<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenyidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penyidikan = [
            [
                'id' => 'd38bf884-b8b7-4ae4-a8da-ae7dab96d833',
                'nomor_penyidikan' => '001',
                'kasus_id' => '59353d58-ae92-4b94-b13a-ce7f64257135',
                'waktu_dimulai_penyidikan' => '2024-05-28',
                'agenda_penyidikan' => 'penyidikan',
                'waktu_selesai_penyidikan' => '2024-05-28',
                'dokumen_bap_id' => '9c2417c1-9bd2-496d-4102-8aec799aee90',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312w',
                'saksi_id' => '9c26a442-681a-4faf-af7a-11b4c40282f4',
                'oditur_penyidikan_id' => 'a5b00059-b97f-4561-a987-382477f40fd8',
                'zona_waktu' => 'WIB',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('penyidikan')->insert($penyidikan);
    }
}
