<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Provinsi = [
            [
                "id" => Str::uuid(),
                "nama_provinsi" => "Aceh",
                "created_at" => now(),
                "updated_at" => now(),
            ]
        ];
        DB::table("provinsi")->insert($Provinsi);
    }
}
