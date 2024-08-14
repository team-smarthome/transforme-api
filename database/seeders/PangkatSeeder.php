<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class PangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pangkat = [
            ['id' => "4ec3de3b-169f-4313-9b3d-0cef9ae3cbda", 'nama_pangkat' => 'Letnan Senior','created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('pangkat')->insert($pangkat);
    }
}
