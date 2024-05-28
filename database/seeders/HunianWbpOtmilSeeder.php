<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HunianWbpOtmilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hunianWbpOtmil = [
            [
                'id' => "60a3465d-5038-4268-b8da-c001fae0e63f",
                'lokasi_otmil_id' => '890cc9b1-b01f-4d1f-9075-a6a96e851b25',
                'nama_hunian_wbp_otmil' => 'Rumah',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('hunian_wbp_otmil')->insert($hunianWbpOtmil);
    }
}
