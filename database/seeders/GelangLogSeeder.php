<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GelangLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gelangLog = [
            [
                'id' => '333aac40-2d61-4d54-8576-7539cb2590ba',
                'gelang_id' => '6ced89b4-f889-489d-a777-a1487c392901',
                'v_gmac' => '123456',
                'v_dmac' => '123456',
                'v_vbatt' => '123456',
                'v_step' => '123456',
                'v_heartrate' => '123456',
                'v_temp' => '20',
                'v_spo' => '20',
                'v_systolic' => '20',
                'v_diastolic' => '20',
                'v_rssi' => '02',
                'n_cutoff_flag' => 0,
                'n_type' => 1,
                'v_x0' => '10',
                'v_y0' => '10',
                'v_z0' => '10',
                'd_time' => now(),
                'n_isavailable' => 0,
                'v_gateway_topic' => 'topic',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '333aac40-2d61-4d54-8571-7539cb2590ba',
                'gelang_id' => '6ced89b4-f889-489d-a777-a1487c392901',
                'v_gmac' => '123456',
                'v_dmac' => '123456',
                'v_vbatt' => '123456',
                'v_step' => '123456',
                'v_heartrate' => '123456',
                'v_temp' => '20',
                'v_spo' => '20',
                'v_systolic' => '20',
                'v_diastolic' => '20',
                'v_rssi' => '02',
                'n_cutoff_flag' => 0,
                'n_type' => 1,
                'v_x0' => '10',
                'v_y0' => '10',
                'v_z0' => '10',
                'd_time' => now(),
                'n_isavailable' => 0,
                'v_gateway_topic' => 'topic',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '333aac40-2dc1-4d54-8576-7539cb2590ba',
                'gelang_id' => '6ced89b4-f889-489d-a777-a1487c392901',
                'v_gmac' => '123456',
                'v_dmac' => '123456',
                'v_vbatt' => '123456',
                'v_step' => '123456',
                'v_heartrate' => '123456',
                'v_temp' => '20',
                'v_spo' => '20',
                'v_systolic' => '20',
                'v_diastolic' => '20',
                'v_rssi' => '02',
                'n_cutoff_flag' => 0,
                'n_type' => 1,
                'v_x0' => '10',
                'v_y0' => '10',
                'v_z0' => '10',
                'd_time' => now(),
                'n_isavailable' => 0,
                'v_gateway_topic' => 'topic',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '333aac40-2d61-4d54-8576-7139cb2490ba',
                'gelang_id' => '6ced89b4-f889-489d-a777-a1487c392901',
                'v_gmac' => '123456',
                'v_dmac' => '123456',
                'v_vbatt' => '123456',
                'v_step' => '123456',
                'v_heartrate' => '123456',
                'v_temp' => '20',
                'v_spo' => '20',
                'v_systolic' => '20',
                'v_diastolic' => '20',
                'v_rssi' => '02',
                'n_cutoff_flag' => 0,
                'n_type' => 1,
                'v_x0' => '10',
                'v_y0' => '10',
                'v_z0' => '10',
                'd_time' => now(),
                'n_isavailable' => 0,
                'v_gateway_topic' => 'topic',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '333aac40-2d61-4q54-8576-7539cb2590ba',
                'gelang_id' => '6ced89b4-f889-489d-a777-a1487c392901',
                'v_gmac' => '123456',
                'v_dmac' => '123456',
                'v_vbatt' => '123456',
                'v_step' => '123456',
                'v_heartrate' => '123456',
                'v_temp' => '20',
                'v_spo' => '20',
                'v_systolic' => '20',
                'v_diastolic' => '20',
                'v_rssi' => '02',
                'n_cutoff_flag' => 0,
                'n_type' => 1,
                'v_x0' => '10',
                'v_y0' => '10',
                'v_z0' => '10',
                'd_time' => now(),
                'n_isavailable' => 0,
                'v_gateway_topic' => 'topic',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('gelang_log')->insert($gelangLog);
    }
}
