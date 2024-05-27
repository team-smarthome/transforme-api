<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class MatraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matra = [
            ['id' => "4b7d979d-b5bd-487b-8429-c8b9b12af860", 'nama_matra' => 'Angkatan Laut','created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('matra')->insert($matra);
    }
}
