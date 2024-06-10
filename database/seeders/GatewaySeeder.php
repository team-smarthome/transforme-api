<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gateway = [
            [
                'id' => '72aa48ca-f1d9-42ba-9d65-8dc2b97fe2ff',
                'gmac' => '00:0a:95:9d:68:16',
                'nama_gateway' => 'Gateway 1',
                'ruangan_otmil_id' => 'f6e62e45-498d-45a8-affd-e5e363c99442',
                'ruangan_lemasmil_id' => 'db10dd62-c048-44bb-a85e-9c2955170420',
                'status_gateway' => 'Aktif',
                'v_gateway_topic' => 'v1/gateway/00:0a:95:9d:68:16',
                'created_at' => now(),
            ]
        ];

        DB::table('gateway')->insert($gateway);
    }
}
