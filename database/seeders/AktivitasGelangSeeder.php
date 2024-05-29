<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AktivitasGelangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aktivitasGelang = [ 
            [
                "id"=> Str::uuid(),
                "gmac"=> "Random",
                "dmac"=> "Random",
                "baterai"=> "Random",
                "step"=> "Random",
                "heartrate"=> "Random",
                "temp"=> "Random",
                "spo"=> "Random",
                "systolic"=> "Random",
                "diastolic"=> "Random",
                "cutoff_flag" => 1,
                "type"=> "Random",
                "x0"=> "Random",
                "y0"=> "Random",
                "z0"=> "Random",
                "timestamp"=> now(),
                "wbp_profile_id"=> "",
                "rssi"=> "Random",
                "created_at"=> now(),
                "updated_at"=> now()
            ],
        ];
        DB::table('aktivitas_gelang')->insert($aktivitasGelang);
    }
}
