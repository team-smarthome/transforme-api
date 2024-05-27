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
                'id' => Str::uuid(),
                'kategori_perkara_id' => '9c24304a-c34d-405f-a3a9-ae64496e7495',
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
