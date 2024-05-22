<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class LokasiOtmilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lokasi_otmil = [
            ['id' => Str::uuid(), 'nama_lokasi_otmil' => 'Jakarta Otmil',
            'latitude' => '123456', 'longitude' => '123456',
            'panjang' => '123456', 'lebar' => '123456',
            'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('lokasi_otmil')->insert($lokasi_otmil);
    }
}
