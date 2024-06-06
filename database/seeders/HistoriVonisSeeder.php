<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class HistoriVonisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $historiVonis = [
            [
                'id' => 'd54069af-78d0-49fa-aaa4-6e53819eb13a',
                'sidang_id' => '26a2b34e-0c9e-4ad7-a150-d3afc9d937d7',
                'hasil_vonis' => 'Mati',
                'masa_tahanan_tahun' => "1",
                'masa_tahanan_bulan' => "2",
                'masa_tahanan_hari' => "3",
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ];

        DB::table('histori_vonis')->insert($historiVonis);
    }
}
