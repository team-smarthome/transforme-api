<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DokumenPersidanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokumenPersidangan = [
            [
                'id' => "45f62780-52aa-4842-9632-33f9c0c9bfa3",
                'nama_dokumen_persidangan' => 'Dokumen Persidangan 1',
                'link_dokumen_persidangan' => 'https://www.google.com',
                'sidang_id' => '26a2b34e-0c9e-4ad7-a150-d3afc9d937d7',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('dokumen_persidangan')->insert($dokumenPersidangan);
    }
}
