<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class OditurPenyidikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $oditur_penyidik = [
            ['id' => '42258987-87f5-4d33-8920-5fe4d2694d77', 'nip' => '123456', 'nama_oditur' => "Jaka", "alamat" => "jakarta", 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('oditur_penyidik')->insert($oditur_penyidik);
    }
}
