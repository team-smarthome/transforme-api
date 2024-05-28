<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HunianWbpLemasMilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hunianWbpLemasmil = [
            [
                'id' => Str::uuid(),
                'lokasi_lemasmil_id' => '',
                'nama_hunian_wbp_lemasmil' => 'Markas',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('hunian_wbp_lemasmil')->insert($hunianWbpLemasmil);
    }
}
