<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PivotKasusWbpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pivotKasusWbp = [
            [
                'id' => 'c1458262-6739-49d6-87f8-49cb3f6fda4a',
                'kasus_id' => "59353d58-ae92-4b94-b13a-ce7f64257135",
                'wbp_profile_id' => "12cfa0a1-5ab3-4daa-9292-29397946312w",
                'keterangan' => 'Keterangan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('pivot_kasus_wbp')->insert($pivotKasusWbp);
    }
}
