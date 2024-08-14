<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JenisPersidanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $JenisPersidangan = [
            [
                'id' => "e63a5156-f621-45e7-9e39-5e255c6ee059",
                'nama_jenis_persidangan' => 'Sidang Umum',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('jenis_persidangan')->insert($JenisPersidangan);
    }
}
