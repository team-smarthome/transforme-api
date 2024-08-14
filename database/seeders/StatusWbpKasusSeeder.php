<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 


class StatusWbpKasusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status_wbp_kasus = [
            [
                'id' => "5fe19cdd-c9ba-4c83-a575-aa548193ff97",
                'nama_status_wbp_kasus' => "Kasus Apa Aja",
                'created_at' => now(), 'updated_at' => now()
            ]
            ];
        DB::table('status_wbp_kasus')->insert($status_wbp_kasus);
    }
}
