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
            ['id' => Str::uuid(), 'nama' => 'Udin',
            'pangkat_id' => "5db3246b-aef1-489f-8a53-85159a73e9d2",
            'kesatuan_id' => '13cef6fb-93e8-4ba7-a03c-6e81f437c237',
            'tempat_lahir' => 'Jakarta', 
            'tanggal_lahir' => now(),
            'jenis_kelamin' => 1, 
            'provinsi_id' => '15585b43-f9fc-428a-b5b8-1e414183a8f8',
            'kota_id' => 'd4fd934c-5c35-4bb3-9801-2f768acbb0be',
            'alamat' => 'Kebayoran Lama',
            'agama_id' => '8e781bd5-e8ed-44c4-982a-8db1457584d3',
            'status_kawin_id' => '21cbc449-903b-4e97-a3e0-4e02a7f07410',
            'pendidikan_id' => '7ac84b2b-3983-46b7-9e5d-2ef739425564',
            'bidang_keahlian_id' => '34b937cf-9c0e-4d83-8186-2b6ecf89c291',
            'foto_wajah' => 'http',
            'jabatan' => 'Jendral',
            'divisi' => 'Militer',
            'nomor_petugas' => '123456',
            'lokasi_otmil_id' => 'e92d314d-d0a2-4032-960a-f7c34d0c610e',
            'lokasi_lemasmil_id' => '5bd5f9da-81df-420e-9e93-d0092b5be656',
            'grup_petugas_id' => '51d8637a-7d29-43db-af93-663bea94e3ba',
            'nrp' => '1234567890',
            'matra_id' => '20e9da0a-8403-4052-ad85-254ed443aef3',
            'foto_wajah_fr' => 'Udin',
            'lokasi_kesatuan_id' => 'a9227b10-31e2-49f5-8131-6ebddfe54f5d',
            'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('petugas')->insert($petugas);
    }
}
