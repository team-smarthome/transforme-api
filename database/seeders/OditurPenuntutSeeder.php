<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OditurPenuntutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $oditurPenuntut = [
            [
                'id' => "252c6f16-965f-49ca-a70f-353087201c50",
                'nip' => '1234567890',
                'nama_oditur' => 'Rizki',
                'alamat' => 'Jl. Raya',
                'created_at' => now(),
            ]
        ];
        DB::table('oditur_penuntut')->insert($oditurPenuntut);
    }
}
