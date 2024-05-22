<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class BidangKeahlianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bidang_keahlian = [
            ['id' => Str::uuid(), 'nama_bidang_keahlian' => 'Ndak Tau', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('bidang_keahlian')->insert($bidang_keahlian);
    }
}
