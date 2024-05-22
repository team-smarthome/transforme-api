<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = "test1234";
        $users = 
            ['id' => Str::uuid(),
            'username' => 'udin',
            'password' => Hash::make($password),
            "user_role_id" => "856cc916-b107-4e93-bed9-5fd67dc41925",
            "email" => "udin@gmail.com",
            "phone" => "08123123123", 
            "lokasi_otmil_id" => "e92d314d-d0a2-4032-960a-f7c34d0c610e",
            "lokasi_lemasmil_id" => "5bd5f9da-81df-420e-9e93-d0092b5be656",
            "is_suspended" => 0,
            "petugas_id" => "a8c5fbc7-4fbb-407b-8c23-42fc5932dbfa",
            "image" => "udin.jpg",
            "last_login" => now(),
            "expiry_date" => now(),
            "created_at" => now(),
            'updated_at' => now()

          ];
        DB::table('users')->insert($users);
    }
}
