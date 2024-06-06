<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PivotKasusOditurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pivotKasusOditur = [
            [
                'id' => 'dfaa2c4c-14bd-446e-9cd0-e77e598a1340',
                'oditur_penyidikan_id' => '42258987-87f5-4d33-8920-5fe4d2694d77',
                'role_ketua' => 1,
                'kasus_id' => '59353d58-ae92-4b94-b13a-ce7f64257135',
                'created_at' => now(),

            ]
        ];
        DB::table('pivot_kasus_oditur')->insert($pivotKasusOditur);
    }
}
