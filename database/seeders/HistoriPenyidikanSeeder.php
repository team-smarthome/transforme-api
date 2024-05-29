<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoriPenyidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penyidikan = [
            [
                'id' => '8df5513r-814f-406e-a992-812f042d3j86',
                'hasil_penyidikan' => 'Terdakwa bersalah',
                'penyidikan_id' => 'c48bf881-b8b7-4ae4-a8da-ae7dab96d832'
            ]
            ];
            DB::table('histori_penyidikan')->insert($penyidikan);
    }
}
