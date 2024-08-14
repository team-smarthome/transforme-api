<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PivotSidangSaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pivotSidangSaksi = [
            [
                'id' => '41dc12f0-cde0-4f9b-88ca-b3bc848cdbc5',
                'sidang_id' => "26a2b34e-0c9e-4ad7-a150-d3afc9d937d7",
                'saksi_id' => "e0408528-fab5-443b-91f5-adcf2a420dcc",
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('pivot_sidang_saksi')->insert($pivotSidangSaksi);
    }
}
