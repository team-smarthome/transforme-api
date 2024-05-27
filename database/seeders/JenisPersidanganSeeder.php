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
                'id' => Str::uuid(),
                'nama_jenis_persidangan' => 'Sidang Umum',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('jenis_persidangan')->insert($JenisPersidangan);
    }
}
