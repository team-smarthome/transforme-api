<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PengunjungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengunjung = [
            [
                'id' => '0fb4282e-a843-49a3-b319-58cf6dbcc7ea',
                'nama' => 'udin',
                'tempat_lahir' => 'bandung',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 1,
                'provinsi_id' => 'bd304f3c-b18d-4982-8e41-1a3606bdf06e',
                'kota_id' => '20256ac2-caa3-4e7b-802b-eba531b9cf5c',
                'alamat' => 'bandung',
                'foto_wajah' => 'bandung',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'hubungan_wbp' => 'bandung',
                'nik' => 'bandung',
                'foto_wajah_fr' => 'bandung',
                'created_at' => NOW()
            ]
            ];
            DB::table('pengunjung')->insert($pengunjung);
    }
}
