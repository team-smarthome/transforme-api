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
                "id" => 'c48bf881-b8b7-4ae4-a8da-ae7dab96d82a',
                "nama_jenis_pidana" => "Pidana Mati",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id"=> '5746fccc-ee4a-43aa-a5dd-c7cd1b9b2892',
                "nama_jenis_pidana" => "Pidana Penjara",
                "created_at" => now(),
                "updated_at"=> now(),
            ]
        ];
        DB::table("jenis_pidana")->insert($JenisPidana);
    }
}
