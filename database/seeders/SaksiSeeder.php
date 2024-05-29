<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $saksi = [
            [
                'id' => 'e0408528-fab5-443b-91f5-adcf2a420dcc',
                'nama_saksi' => 'saksi',
                'no_kontak' => "1234567890",
                'alamat' => 'test',
                "jenis_kelamin" => 1,
                "kasus_id" => "59353d58-ae92-4b94-b13a-ce7f64257135",
                'keterangan' => 'test',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('saksi')->insert($saksi);
    }
}
