<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shift = [
            [
                'id' => 'c5e99fed-d404-4c3e-a96b-9cfde0e341f5',
                'nama_shift' => 'Shift 1',
                'waktu_mulai' => '08:00:00',
                'waktu_selesai' => '16:00:00',
                'created_at' => now(),
            ]
        ];

        DB::table('shift')->insert($shift);
    }
}
