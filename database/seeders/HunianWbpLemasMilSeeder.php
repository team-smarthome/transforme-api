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
                'id' => "0993f968-a25f-4908-8bc4-68980bb49f22",
                'lokasi_lemasmil_id' => '48633be0-b005-4029-8bbb-293db9564ba0',
                'nama_hunian_wbp_lemasmil' => 'Rumah',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('hunian_wbp_lemasmil')->insert($hunianWbpLemasmil);
    }
}
