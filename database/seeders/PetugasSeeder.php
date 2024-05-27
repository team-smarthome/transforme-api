<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $petugas = [
            ['id' => "873313dd-863a-48f1-a09a-d113e26632b1", 'nama' => 'Udin',
            'pangkat_id' => "4ec3de3b-169f-4313-9b3d-0cef9ae3cbda",
            'kesatuan_id' => '18ff69b7-3d9f-4a60-a602-5baf4f3cc081',
            'tempat_lahir' => 'Jakarta', 
            'tanggal_lahir' => now(),
            'jenis_kelamin' => 1, 
            'provinsi_id' => 'bd304f3c-b18d-4982-8e41-1a3606bdf06e',
            'kota_id' => '847b7af8-f2cc-4b62-96a0-22cc3d1b2511',
            'alamat' => 'Kebayoran Lama',
            'agama_id' => 'd8ff707f-81f6-46ba-b645-73f379ffd9cf',
            'status_kawin_id' => 'dfdfcf57-8ec1-49fc-b160-8f796546b6ce',
            'pendidikan_id' => '997f13b9-4177-4163-81e7-f5d998b2c53e',
            'bidang_keahlian_id' => '65521a02-2aad-40ef-942b-7ead78ff8cbc',
            'foto_wajah' => 'http',
            'jabatan' => 'Jendral',
            'divisi' => 'Militer',
            'nomor_petugas' => '123456',
            'lokasi_otmil_id' => '890cc9b1-b01f-4d1f-9075-a6a96e851b25',
            'lokasi_lemasmil_id' => '48633be0-b005-4029-8bbb-293db9564ba0',
            'grup_petugas_id' => 'cbdf72a3-f10a-452c-ae13-32d8cb483919',
            'nrp' => '1234567890',
            'matra_id' => '4b7d979d-b5bd-487b-8429-c8b9b12af860',
            'foto_wajah_fr' => 'Udin',
            'lokasi_kesatuan_id' => 'd54069af-78d0-49fa-aaa4-6e53819eb13a',
            'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('petugas')->insert($petugas);
    }
}
