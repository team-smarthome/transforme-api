<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agama = [
            ['id' => "d8ff707f-81f6-46ba-b645-73f379ffd9cf", 'nama_agama' => 'Islam', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('agama')->insert($agama);
    }
}
