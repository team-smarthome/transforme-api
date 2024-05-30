<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AhliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ahli = [
            [
                "id" => "bcfdd5e2-079e-4c71-8bd1-aaa762cbcf9a",
                "nama_ahli" => "Rizki",
                "bidang_ahli" => "Navigasi",
                "bukti_keahlian" => "Sertifikasi",
                "created_at" => now(),
                "updated_at"=> now(),
            ]
        ];
        DB::table("ahli")->insert($ahli);
    }
}
