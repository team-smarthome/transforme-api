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
        $provinsi = [
            [ "id" => "a00fa162-5cd1-475e-ad81-03426a7f7952", "nama_provinsi" => "Aceh", "created_at" => now(),"updated_at" => now(),],
            ['id' => "bd304f3c-b18d-4982-8e41-1a3606bdf06e", 'nama_provinsi' => 'Jakarta', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('provinsi')->insert($provinsi);
    }
}
