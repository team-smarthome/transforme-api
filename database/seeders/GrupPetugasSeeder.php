<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class GrupPetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grup_petugas = [
            ['id' => "cbdf72a3-f10a-452c-ae13-32d8cb483919", 'nama_grup_petugas' => 'Grup Tadika Mesra', 'ketua_grup' => "udin", 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('grup_petugas')->insert($grup_petugas);
    }
}
