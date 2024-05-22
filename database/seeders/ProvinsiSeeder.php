<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
<<<<<<< HEAD
use Illuminate\Support\Str;
=======
use Illuminate\Support\Str; 
>>>>>>> 8dd81bd5d56a1ac2c32ca717379e4595f5ec6bbe

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
        $Provinsi = [
            [
                "id" => Str::uuid(),
                "nama_provinsi" => "Aceh",
                "created_at" => now(),
                "updated_at" => now(),
            ]
        ];
        DB::table("provinsi")->insert($Provinsi);
=======
        $provinsi = [
            ['id' => Str::uuid(), 'nama_provinsi' => 'Jakarta', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('provinsi')->insert($provinsi);
>>>>>>> 8dd81bd5d56a1ac2c32ca717379e4595f5ec6bbe
    }
}
