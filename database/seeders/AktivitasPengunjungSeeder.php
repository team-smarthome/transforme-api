<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AktivitasPengunjungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aktivitasPengunjung = [
            [
                'id' => 'c8974622-51c2-44b9-9f34-9339635cbc90',
                'nama_aktivitas_pengunjung' => 'Pengunjung Masuk 1',
                'waktu_mulai_kunjungan' => '2021-10-01 08:00:00',
                'waktu_selesai_kunjungan' => '2021-10-01 09:00:00',
                'tujuan_kunjungan' => 'Tujuan Kunjungan 1',
                'ruangan_otmil_id' => 'f6e62e45-498d-45a8-affd-e5e363c99442',
                'ruangan_lemasmil_id' => null,
                'petugas_id' => '873313dd-863a-48f1-a09a-d113e26632b1',
                'pengunjung_id' => '0fb4282e-a843-49a3-b319-58cf6dbcc7ea',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'zona_waktu' => 'WIB',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 'c8974622-51c2-44b9-9f34-9339635fbc90',
                'nama_aktivitas_pengunjung' => 'Pengunjung Masuk 2',
                'waktu_mulai_kunjungan' => '2021-10-01 08:00:00',
                'waktu_selesai_kunjungan' => '2021-10-01 09:00:00',
                'tujuan_kunjungan' => 'Tujuan Kunjungan 2',
                'ruangan_otmil_id' => 'f6e62e45-498d-45a8-affd-e5e363c99442',
                'ruangan_lemasmil_id' => null,
                'petugas_id' => '873313dd-863a-48f1-a09a-d113e26632b1',
                'pengunjung_id' => '0fb4282e-a843-49a3-b319-58cf6dbcc7ea',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'zona_waktu' => 'WIB',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 'c8974622-51c2-44b9-9f34-9339635cbc9a',
                'nama_aktivitas_pengunjung' => 'Pengunjung Masuk 3',
                'waktu_mulai_kunjungan' => '2021-10-01 08:00:00',
                'waktu_selesai_kunjungan' => '2021-10-01 09:00:00',
                'tujuan_kunjungan' => 'Tujuan Kunjungan 3',
                'ruangan_otmil_id' => 'f6e62e45-498d-45a8-affd-e5e363c99442',
                'ruangan_lemasmil_id' => null,
                'petugas_id' => '873313dd-863a-48f1-a09a-d113e26632b1',
                'pengunjung_id' => '0fb4282e-a843-49a3-b319-58cf6dbcc7ea',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'zona_waktu' => 'WIB',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 'c8974622-51c2-44b9-9f34-2339635cbc90',
                'nama_aktivitas_pengunjung' => 'Pengunjung Masuk 4',
                'waktu_mulai_kunjungan' => '2021-10-01 08:00:00',
                'waktu_selesai_kunjungan' => '2021-10-01 09:00:00',
                'tujuan_kunjungan' => 'Tujuan Kunjungan 4',
                'ruangan_otmil_id' => 'f6e62e45-498d-45a8-affd-e5e363c99442',
                'ruangan_lemasmil_id' => null,
                'petugas_id' => '873313dd-863a-48f1-a09a-d113e26632b1',
                'pengunjung_id' => '0fb4282e-a843-49a3-b319-58cf6dbcc7ea',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'zona_waktu' => 'WIB',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 'c8974622-51c2-44b9-9f34-9339635cxc90',
                'nama_aktivitas_pengunjung' => 'Pengunjung Masuk 5',
                'waktu_mulai_kunjungan' => '2021-10-01 08:00:00',
                'waktu_selesai_kunjungan' => '2021-10-01 09:00:00',
                'tujuan_kunjungan' => 'Tujuan Kunjungan 5',
                'ruangan_otmil_id' => 'f6e62e45-498d-45a8-affd-e5e363c99442',
                'ruangan_lemasmil_id' => null,
                'petugas_id' => '873313dd-863a-48f1-a09a-d113e26632b1',
                'pengunjung_id' => '0fb4282e-a843-49a3-b319-58cf6dbcc7ea',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'zona_waktu' => 'WIB',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 'c8974622-51c2-44b9-9f34-9339635cbc98',
                'nama_aktivitas_pengunjung' => 'Pengunjung Masuk 6',
                'waktu_mulai_kunjungan' => '2021-10-01 08:00:00',
                'waktu_selesai_kunjungan' => '2021-10-01 09:00:00',
                'tujuan_kunjungan' => 'Tujuan Kunjungan 6',
                'ruangan_otmil_id' => 'f6e62e45-498d-45a8-affd-e5e363c99442',
                'ruangan_lemasmil_id' => null,
                'petugas_id' => '873313dd-863a-48f1-a09a-d113e26632b1',
                'pengunjung_id' => '0fb4282e-a843-49a3-b319-58cf6dbcc7ea',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'zona_waktu' => 'WIB',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'id' => 'c8974622-51c2-44b9-9f34-9339633cbc90',
                'nama_aktivitas_pengunjung' => 'Pengunjung Masuk 7',
                'waktu_mulai_kunjungan' => '2021-10-01 08:00:00',
                'waktu_selesai_kunjungan' => '2021-10-01 09:00:00',
                'tujuan_kunjungan' => 'Tujuan Kunjungan 7',
                'ruangan_otmil_id' => 'f6e62e45-498d-45a8-affd-e5e363c99442',
                'ruangan_lemasmil_id' => null,
                'petugas_id' => '873313dd-863a-48f1-a09a-d113e26632b1',
                'pengunjung_id' => '0fb4282e-a843-49a3-b319-58cf6dbcc7ea',
                'wbp_profile_id' => '12cfa0a1-5ab3-4daa-9292-29397946312o',
                'zona_waktu' => 'WIB',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ];
        DB::table('aktivitas_pengunjung')->insert($aktivitasPengunjung);
    }
}
