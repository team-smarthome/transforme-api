<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GatewayLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gatewayLog = [
            [
                'id' => '333aac40-2d61-4d54-8576-7539cb2590ba',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'image' => 'gateway_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'gateway_id' => '72aa48ca-f1d9-42ba-9d65-8dc2b97fe2ff',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '333aac40-2d61-4d54-8576-7539ab2590ba',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'image' => 'gateway_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'gateway_id' => '72aa48ca-f1d9-42ba-9d65-8dc2b97fe2ff',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '333aac40-2d61-4d54-8576-7539xb2590ba',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'image' => 'gateway_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'gateway_id' => '72aa48ca-f1d9-42ba-9d65-8dc2b97fe2ff',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '333aac40-2d61-4d54-8576-7539cb3590ba',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'image' => 'gateway_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'gateway_id' => '72aa48ca-f1d9-42ba-9d65-8dc2b97fe2ff',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '333aac40-2d61-4154-8576-7539cb2590ba',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'image' => 'gateway_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'gateway_id' => '72aa48ca-f1d9-42ba-9d65-8dc2b97fe2ff',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '333aac40-2d61-4d54-7576-7539cb2590ba',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'image' => 'gateway_log_image/evLlSOQtNYFKWHhjCUsl6DZhg5qEHPNpSWWmy3cx.png',
                'gateway_id' => '72aa48ca-f1d9-42ba-9d65-8dc2b97fe2ff',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('gateway_log')->insert($gatewayLog);
    }
}
