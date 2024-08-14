<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HakimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hakim = [
            [
                'id' => 'd0495595-1b21-421c-a010-d71408f967ea',
                'nip' => '1234567890',
                'nama_hakim' => 'Hakim 1',
                'alamat' => 'Jl. Hakim 1',
                'departemen' => 'Hakim',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 'd0495595-1b21-421c-a110-d71408f967ea',
                'nip' => '1234567890',
                'nama_hakim' => 'Hakim 2',
                'alamat' => 'Jl. Hakim 2',
                'departemen' => 'Hakim',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 'd0495595-1b21-421c-a510-d71408f967ea',
                'nip' => '1234567890',
                'nama_hakim' => 'Hakim 3',
                'alamat' => 'Jl. Hakim 3',
                'departemen' => 'Hakim',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 'd0495595-1b21-421c-a010-d71418f967ea',
                'nip' => '1234567890',
                'nama_hakim' => 'Hakim 4',
                'alamat' => 'Jl. Hakim 4',
                'departemen' => 'Hakim',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 'd0495595-1b21-421c-a010-d71408f967eq',
                'nip' => '1234567890',
                'nama_hakim' => 'Hakim 5',
                'alamat' => 'Jl. Hakim 5',
                'departemen' => 'Hakim',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 'd0495595-1b21-421c-a010-b71408f967ea',
                'nip' => '1234567890',
                'nama_hakim' => 'Hakim 6',
                'alamat' => 'Jl. Hakim 6',
                'departemen' => 'Hakim',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 'd0495595-1b21-421c-a010-h71408f967ea',
                'nip' => '1234567890',
                'nama_hakim' => 'Hakim 7',
                'alamat' => 'Jl. Hakim 7',
                'departemen' => 'Hakim',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ];

        DB::table('hakim')->insert($hakim);
    }
}
