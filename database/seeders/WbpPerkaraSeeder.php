<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WbpPerkaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wbpPerkara = [
            [
                'id' => "56cd185a-7008-4254-a9a1-20014076eed0",
                'kategori_perkara_id' => "8df5515e-814f-406c-a995-812f042d3c84",
                'jenis_perkara_id' => "4c7b0b7e-328f-41ef-a443-6879e45c6ae2",
                'vonis_tahun' => 2,
                'vonis_bulan' => 1,
                'vonis_hari' => 1,
                'tanggal_ditahan_otmil' => '2021-01-01',
                'tanggal_ditahan_lemasmil' => '2021-01-01',
                'lokasi_otmil_id' => "890cc9b1-b01f-4d1f-9075-a6a96e851b25",
                'lokasi_lemasmil_id' => "48633be0-b005-4029-8bbb-293db9564ba0",
                'residivis' => 1,
                'wbp_profile_id' => "12cfa0a1-5ab3-4daa-9292-29397946312o",
                'created_at' => now(),
            ]
        ];
        DB::table('wbp_perkara')->insert($wbpPerkara);
    }
}
