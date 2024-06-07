<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KameraLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kameraLog = [
            [
                'id' => '5de79f81-22e3-430f-9696-8916026d4e68',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'image' => 'kamera_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'timestamp' => '2021-10-01 08:00:00',
                'kamera_id' => 'a30fcedb-a6a6-490d-bdef-31780b4ad016',
                'foto_wajah_fr' => 'kamera_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '5de79f81-22e3-430f-5696-8916026d4e68',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'image' => 'kamera_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'timestamp' => '2021-10-01 08:00:00',
                'kamera_id' => 'a30fcedb-a6a6-490d-bdef-31780b4ad016',
                'foto_wajah_fr' => 'kamera_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '5de79f81-22e3-430f-9696-8912026d4e68',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'image' => 'kamera_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'timestamp' => '2021-10-01 08:00:00',
                'kamera_id' => 'a30fcedb-a6a6-490d-bdef-31780b4ad016',
                'foto_wajah_fr' => 'kamera_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '5de79f81-22e3-430f-9696-8916026ase68',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'image' => 'kamera_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'timestamp' => '2021-10-01 08:00:00',
                'kamera_id' => 'a30fcedb-a6a6-490d-bdef-31780b4ad016',
                'foto_wajah_fr' => 'kamera_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '5de79f81-22e3-430f-9696-8916026d4eff',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'image' => 'kamera_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'timestamp' => '2021-10-01 08:00:00',
                'kamera_id' => 'a30fcedb-a6a6-490d-bdef-31780b4ad016',
                'foto_wajah_fr' => 'kamera_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('kamera_log')->insert($kameraLog);
    }
}
