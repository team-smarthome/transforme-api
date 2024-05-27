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
            ['id' => "65521a02-2aad-40ef-942b-7ead78ff8cbc", 'nama_bidang_keahlian' => 'Ndak Tau', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('bidang_keahlian')->insert($bidang_keahlian);
    }
}
