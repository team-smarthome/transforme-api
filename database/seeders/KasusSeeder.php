<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KasusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kasus = [
            [
                'id' => Str::uuid(),
                'nama_kasus' => 'Perampokan',
                'nomor_kasus' => '001',
            ]
        ];
        DB::table('kasus')->insert($kasus);
    }
}
