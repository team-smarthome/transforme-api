<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PivotSidangAhliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pivotSidangAhli = [
            [
                'id' => 'c1458262-6739-49d6-87f8-49cb3f6fda4a',
                'sidang_id' => "26a2b34e-0c9e-4ad7-a150-d3afc9d937d7",
                'ahli_id' => "bcfdd5e2-079e-4c71-8bd1-aaa762cbcf9a",
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('pivot_sidang_ahli')->insert($pivotSidangAhli);
    }
}
