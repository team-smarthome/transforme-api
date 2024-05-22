<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
<<<<<<< HEAD
<<<<<<< HEAD
use Illuminate\Support\Str;
=======
use Illuminate\Support\Str; 
>>>>>>> 8dd81bd5d56a1ac2c32ca717379e4595f5ec6bbe
=======
use Illuminate\Support\Str;
>>>>>>> 0b091ab5b3edbc386a4c2d7d8cf778e5ba5088ba

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 0b091ab5b3edbc386a4c2d7d8cf778e5ba5088ba
        $Provinsi = [
            [
                "id" => Str::uuid(),
                "nama_provinsi" => "Aceh",
                "created_at" => now(),
                "updated_at" => now(),
            ]
        ];
        DB::table("provinsi")->insert($Provinsi);
<<<<<<< HEAD
=======
        $provinsi = [
            ['id' => Str::uuid(), 'nama_provinsi' => 'Jakarta', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('provinsi')->insert($provinsi);
>>>>>>> 8dd81bd5d56a1ac2c32ca717379e4595f5ec6bbe
=======
>>>>>>> 0b091ab5b3edbc386a4c2d7d8cf778e5ba5088ba
    }
}
