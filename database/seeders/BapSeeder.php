<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bap = [
            'id' => '18001290-7ccf-4bf4-b6bf-5d93e033cf2f',
            'penyidikan_id' => 'd38bf884-b8b7-4ae4-a8da-ae7dab96d833',
            'dokumen_bap_id' => '80e7e21a-4272-43ac-a5aa-d48a4c0ee835',
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('bap')->insert($bap);
    }
}
