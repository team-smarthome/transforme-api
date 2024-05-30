<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedule = [
            [
                'id' => 'b1b3b3b3-1f81-4329-982c-0c290077846f',
                'tanggal' => 12,
                'bulan' => 2,
                'tahun' => 2021,
                'shift_id' => 'c5e99fed-d404-4c3e-a96b-9cfde0e341f5',
                'created_at' => now(),
            ]
        ];

        DB::table('schedule')->insert($schedule);
    }
}
