<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerkaraPersidanganTersangkaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perkaraPersidanganTersangka = [
            [
                'id' => '26ae551d-d1c5-493f-94bc-99934f416a58',
                'nama_perkara_persidangan_tersangka' => 'Perkara Persidangan Tersangka 1',
                'nomor_perkara_persidangan_tersangka' => '1234',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312w',
                'status_perkara_persidangan_tersangka' => 'Aktif',
                'tanggal_penetapan_tersangka' => '2021-01-01',
                'tanggal_registrasi_tersangka' => '2021-01-01',
                'oditur_id' => '42258987-87f5-4d33-8920-5fe4d2694d77',
                'lama_proses_persidangan_tersangka' => 1,
                'dokumen_bap_id' => '9c2417c1-9bd2-496d-4102-8aec799aee90',
                'created_at' => now(),
            ]
            ];
    }
}
