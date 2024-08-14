<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KegiatanWbpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kegiatanWbp = [
            [
                'id' => '9fde7d1f-ca62-4af3-96db-a567bd6sc0c2',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'kegiatan_id' => '9c3275c0-de26-43d6-9e33-1be904x0eba1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '9fde7d1f-ca62-4af3-96db-a567bd63a0c2',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'kegiatan_id' => '9c3275c0-de26-43d6-9e33-1be904x0eba1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '9fde7d1f-ca62-4af3-96db-ab67bd63c0c2',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'kegiatan_id' => '9c3275c0-de26-43d6-9e33-1be904x0eba1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '9fde7d1f-ca62-4af3-96db-a567bq63c0c2',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'kegiatan_id' => '9c3275c0-de26-43d6-9e33-1be904x0eba1',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('kegiatan_wbp')->insert($kegiatanWbp);
    }
}
