<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JenisPidanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $JenisPidana = [
            [
                "id" => Str::uuid(),
                "nama_jenis_pidana" => "Pidana Mati",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id"=> Str::uuid(),
                "nama_jenis_pidana" => "Pidana Penjara",
                "created_at" => now(),
                "updated_at"=> now(),
            ]
        ];
        DB::table("jenis_pidana")->insert($JenisPidana);
    }
}
