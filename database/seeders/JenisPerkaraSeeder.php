<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JenisPerkaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisPerkara = [
            [
                'id' => '4c7b0b7e-328f-41ef-a443-6879e45c6ae2',
                'kategori_perkara_id' => '8df5515e-814f-406c-a995-812f042d3c84',
                'nama_jenis_perkara' => 'Random',
                'pasal' => 'Random',
                'vonis_tahun_perkara' => 2,
                'vonis_bulan_perkara' => 1,
                'vonis_hari_perkara' => 1,
                'created_at' => now(),
                'updated_at'=> now(),
            ]
        ];
        DB::table('jenis_perkara')->insert($jenisPerkara);
    }
}
