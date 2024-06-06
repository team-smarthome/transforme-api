<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TipeAsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipeAset = [
            [
                'id' => '7911d5aa-1f81-4329-982c-0c290077846d',
                'nama_tipe' => 'Kendaraan',
                'created_at' => now(),
            ]
        ];

        DB::table('tipe_aset')->insert($tipeAset);
    }
}
