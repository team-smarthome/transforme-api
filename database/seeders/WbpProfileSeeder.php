<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WbpProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wbp_profile = [
            [
                'id' => "12cfa0a1-5ab3-4daa-9292-29397946312o",
                'nama' => "Udin",
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
                'nomor_tahanan' => '123456',
                'residivis' => 1,
                'status_wbp_kasus_id' => '9c240524-bea5-43c4-8f41-7ed1f8bbab4c',
                'foto_wajah_fr' => 'Udin',
                'is_isolated' => 1,
                'is_sick' => 1,
                'wbp_sickness' => 'Flu',
                'gelang_id' => '9c264aaf-b4a3-40c2-8ae4-41296aa9bce0',
                'hunian_wbp_otmil_id' => '60a3465d-5038-4268-b8da-c001fae0e63f',
                'hunian_wbp_lemasmil_id' => '0993f968-a25f-4908-8bc4-68980bb49f22',
                'status_keluarga' => 'Ipar',
                'nama_kontak_keluarga' => 'Udin Lagi',
                'hubungan_kontak_keluarga' => 'Ipar',
                'nomor_kontak_keluarga' => '1234567890',
                'matra_id' => '4b7d979d-b5bd-487b-8429-c8b9b12af860',
                'nrp' => '8987766',
                'tanggal_ditahan_otmil' => now(),
                'tanggal_ditahan_lemasmil' => now(),
                'tanggal_penetapan_tersangka' => now(),
                'tanggal_penetapan_terdakwa' => now(),
                'tanggal_penetapan_terpidana' => now(),
                'kasus_id' => '59353d58-ae92-4b94-b13a-ce7f64257135',
                'is_diperbantukan' => 1,
                'tanggal_masa_penahanan_otmil' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]

        ];
        DB::table('wbp_profile')->insert($wbp_profile);
    }
}
