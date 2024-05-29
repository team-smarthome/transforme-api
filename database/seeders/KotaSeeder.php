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
            ['id' => "847b7af8-f2cc-4b62-96a0-22cc3d1b2511", 'nama_kota' => 'Jakarta Selatan', 'provinsi_id' => 'bd304f3c-b18d-4982-8e41-1a3606bdf06e', 'created_at' => now(), 'updated_at' => now()],
            ['id' => "a546390a-8024-4300-b024-48102874b882", 'nama_kota' => 'Jakarta Barat', 'provinsi_id' => 'bd304f3c-b18d-4982-8e41-1a3606bdf06e', 'created_at' => now(), 'updated_at' => now()],
            ['id' => "20256ac2-caa3-4e7b-802b-eba531b9cf5c", 'nama_kota' => 'Jakarta Utara', 'provinsi_id' => 'bd304f3c-b18d-4982-8e41-1a3606bdf06e', 'created_at' => now(), 'updated_at' => now()],
            ['id' => "e31c11f8-0e47-401e-a326-688013f9b483", 'nama_kota' => 'Jakarta Timur', 'provinsi_id' => 'bd304f3c-b18d-4982-8e41-1a3606bdf06e', 'created_at' => now(), 'updated_at' => now()],
            ['id' => "712edf09-2a39-4515-aff8-531ed9f69523", 'nama_kota' => 'Jakarta Pusat', 'provinsi_id' => 'bd304f3c-b18d-4982-8e41-1a3606bdf06e', 'created_at' => now(), 'updated_at' => now()],
            ['id' => "0fcd2747-8ed5-41ea-b81d-5600b1c59b05", 'nama_kota' => 'Banda Aceh', 'provinsi_id' => 'a00fa162-5cd1-475e-ad81-03426a7f7952', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('kota')->insert($kota);
    }
}
