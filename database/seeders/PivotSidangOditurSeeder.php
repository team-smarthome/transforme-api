<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PivotSidangOditurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pivotSidangOditur = [
            [   
                'id' => '13fb0af2-3d2b-4131-a1d0-638daeff4920',
                'sidang_id' => "26a2b34e-0c9e-4ad7-a150-d3afc9d937d7",
                'role_ketua' => 1,
                'oditur_penuntut_id' => "252c6f16-965f-49ca-a70f-353087201c50",
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('pivot_sidang_oditur')->insert($pivotSidangOditur);
    }
}
