<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenilaianKegiatanWbpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penilainKegiatanWbp = [
            [
                'id' => "84f97d51-0859-483c-bdb5-82996c73d6c3",
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312w',
                'kegiatan_id' => '9c3275c0-de26-43d6-9e33-1be90400eba1',
                'absensi' => 'Hadir',
                'durasi' => '2',
                'nilai' => '90',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

         DB::table('penilaian_kegiatan_wbp')->insert($penilainKegiatanWbp);
    }
}
