<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JaksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jaksa = [
            [
                'id' => Str::uuid(),
                'nrp_jaksa' => '001',
                'nama_jaksa' => 'Rizki',
                'alamat' => 'Jakarta',
                'nomor_telepon' => '08123232323',
                'email' => 'random10@gmail.com',
                'jabatan' => 'Random',
                'spesialisasi_hukum' => 'Random',
                'divisi' => 'Pertahanan',
                'tanggal_pensiun' => '2024-01-01',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('jaksa')->insert($jaksa);
    }
}
