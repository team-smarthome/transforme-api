<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kota = [
            ['id' => Str::uuid(), 'nama_kota' => 'Udin', 'provinsi_id' => 'b815fde4-9c35-4bd4-bb66-2113c348140b', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('kota')->insert($kota);
    }
}
