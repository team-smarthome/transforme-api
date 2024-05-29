<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zona = [
            [
                'id' => 'e6884cad-d514-4db3-b4cc-5ab2465c6b99',
                'nama_zona' => 'Zona Merah',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('zona')->insert($zona);
    }
}
