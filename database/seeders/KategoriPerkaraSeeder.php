<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriPerkaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriPerkara = [
            [
                'id' => Str::uuid(),
                'nama_kategori_perkara' => 'Perkara Perdata',
                'jenis_pidana_id'=> '9c1f0c3a-e5fe-450f-99ef-e912ae328c2c',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ];
        DB::table('kategori_perkara')->insert($kategoriPerkara);
    }
}
