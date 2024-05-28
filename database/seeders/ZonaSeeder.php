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
                'id' => Str::uuid(),
                'nama_zona' => 'Zona Merah',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('zona')->insert($zona);
    }
}
