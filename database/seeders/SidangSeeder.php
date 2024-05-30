<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sidang = [
            [
                'id' => '26a2b34e-0c9e-4ad7-a150-d3afc9d937d7',
                'nama_sidang' => 'Sidang Umum',
                'jadwal_sidang' => '2021-10-10 10:10:10',
                'perubahan_jadwal_sidang' => '2021-10-10 10:10:10',
                'kasus_id' => '59353d58-ae92-4b94-b13a-ce7f64257135',
                'tanggal_sidang' => '2021-10-10',
                'waktu_mulai_sidang' => '2021-10-10 10:10:10',
                'waktu_selesai_sidang' => '2021-10-10 10:10:10',
                'pengadilan_militer_id' => '39ee0d88-9ea7-489a-8a8a-6828c51a58ce',
                'agenda_sidang' => 'Pemeriksaan Saksi',
                'hasil_keputusan_sidang' => 'Ditolak',
                'jenis_persidangan_id' => 'e63a5156-f621-45e7-9e39-5e255c6ee059',
                'juru_sita' => 'Joko',
                'juru_pengacara_sidang' => 'Joko',
                'pengawas_peradilan_militer' => 'Joko',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312w',
                'zona_waktu' => 'WIB',
                'created_at' => now()
            ]
        ];

        DB::table('sidang')->insert($sidang);
    }
}
