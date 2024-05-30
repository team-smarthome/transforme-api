<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class UserLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userLog = [
            ['id' => "9255fb38-7adb-4bfb-9687-39f2d2513724", 'nama_user_log' => 'Udin', 'timestamp' => '1999-1-10 02:02:02', 'user_id' => "f9c91240-d833-4f17-928d-c73c3edcc30b", 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('user_log')->insert($userLog);
    }
}
