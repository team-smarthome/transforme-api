<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class VersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $version = [
            [
                'id' => 'b1b3b3b3-1f81-4329-982c-0c290077846d',
                'link' => 'ht',
                'version_name' => "1.0.0",
                'created_at' => now(),
            ]
        ];

        DB::table('version')->insert($version);
    }
}
