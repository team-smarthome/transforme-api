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
                'id' => '8df5515e-814f-406c-a995-812f042d3c84',
                'nama_kategori_perkara' => 'Perkara Perdata',
                'jenis_pidana_id'=> 'c48bf881-b8b7-4ae4-a8da-ae7dab96d82a',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ];
        DB::table('kategori_perkara')->insert($kategoriPerkara);
    }
}
