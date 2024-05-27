<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pendidikan = [
            ['id' => "997f13b9-4177-4163-81e7-f5d998b2c53e", 'nama_pendidikan' => 'Sarjana Teknik', 'tahun_lulus' => 2019, 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('pendidikan')->insert($pendidikan);
    }
}
