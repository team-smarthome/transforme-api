<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class LokasiLemasMilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lokasi_lemasmil = [
            ['id' => "48633be0-b005-4029-8bbb-293db9564ba0", 'nama_lokasi_lemasmil' => 'Jakarta Lemasmil',
            'latitude' => '123456', 'longitude' => '123456',
            'panjang' => '123456', 'lebar' => '123456',
            'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('lokasi_lemasmil')->insert($lokasi_lemasmil);
    }
}
