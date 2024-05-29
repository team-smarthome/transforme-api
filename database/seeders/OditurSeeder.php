<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OditurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $oditur = [
            [
                'id' => 'a5b00059-b97f-4561-a987-382477f40fd8',
                'nama_oditur' => 'oditur',
                'created_at' => now(),
                'updated_at' => now(),]
        ];
        DB::table('oditur')->insert($oditur);
    }
}
