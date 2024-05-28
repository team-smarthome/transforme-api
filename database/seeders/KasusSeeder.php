<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KasusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kasus = [
            [
                'id' => "59353d58-ae92-4b94-b13a-ce7f64257135",
                'nama_kasus' => 'Perampokan',
                'nomor_kasus' => '001',
                'wbp_profile_id' => "1213213",
                'kategori_perkara_id' => '8df5515e-814f-406c-a995-812f042d3c84',
                'jenis_perkara_id' => '4c7b0b7e-328f-41ef-a443-6879e45c6ae2',
                'lokasi_kasus' => 'Jakarta',
                'waktu_kejadian' => '2021-01-01 00:00:00',
                'tanggal_pelimpahan_kasus' => '2021-01-01',
                'waktu_pelaporan_kasus' => '2021-01-01 00:00:00',
                'zona_waktu' => 'WIB',
                'tanggal_mulai_penyidikan' => NOW(),
                'tanggal_mulai_sidang' => NOW(),
                'created_at' => now(),
            ]
        ];
        DB::table('kasus')->insert($kasus);
    }
}
