<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BarangBuktiKasusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangBuktiKasus = [
            [
                'id' => 'f9c0516e-c14f-43f8-9825-79679da01f2f',
                'kasus_id' => '59353d58-ae92-4b94-b13a-ce7f64257135',
                'nama_bukti_kasus' => 'Narkotika',
                'nomor_barang_bukti' => '123456',
                'dokumen_barang_bukti' => 'Surat',
                'gambar_barang_bukti' => 'Gambar',
                'keterangan' => 'Keterangan',
                'tanggal_diambil' => now(),
                'longitude' => '123.123',
                'jenis_perkara_id' => '4c7b0b7e-328f-41ef-a443-6879e45c6ae2',
                'created_at' => now(),
            ]
        ];
    }
}
