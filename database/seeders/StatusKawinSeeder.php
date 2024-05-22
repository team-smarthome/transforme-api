<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class StatusKawinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status_kawin = [
            ['id' => Str::uuid(), 'nama_status_kawin' => 'Belum Menikah', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('status_kawin')->insert($status_kawin);
    }
}
