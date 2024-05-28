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
                'id' => Str::uuid(),
                'lokasi_otmil_id' => '9c24546a-e8fd-4b1c-9d94-20ca5040e0d7',
                'nama_hunian_wbp_otmil' => 'Rumah',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('hunian_wbp_otmil')->insert($hunianWbpOtmil);
    }
}
