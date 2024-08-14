<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PenugasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penugasan = [
            [
                'id' => 'b1b3b3b3-1f81-4329-982c-0c290077846a',
                'nama_penugasan' => 'Penugasan 1',
                'created_at' => now(),
            ]
        ];

        DB::table('penugasan')->insert($penugasan);
    }
}
