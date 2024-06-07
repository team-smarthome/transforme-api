<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PivotSidangHakimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pivotSidangHakim = [
            [
                'id' => 'a76e1adb-a4a0-4e0b-bed1-5acfc87ef40e',
                'sidang_id' => '26a2b34e-0c9e-4ad7-a150-d3afc9d937d7',
                'role_ketua' => 1,
                'hakim_id' => 'd0495595-1b21-421c-a010-d71408f967ea',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('pivot_sidang_hakim')->insert($pivotSidangHakim);
    }
}
