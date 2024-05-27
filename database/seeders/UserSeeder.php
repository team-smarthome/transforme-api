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
            ['id' => "f9c91240-d833-4f17-928d-c73c3edcc30b",
            'username' => 'udin',
            'password' => Hash::make($password),
            "user_role_id" => "f1943be9-e062-4815-9a1c-613b1b2260e2",
            "email" => "udin@gmail.com",
            "phone" => "08123123123", 
            "lokasi_otmil_id" => "890cc9b1-b01f-4d1f-9075-a6a96e851b25",
            "lokasi_lemasmil_id" => "48633be0-b005-4029-8bbb-293db9564ba0",
            "is_suspended" => 0,
            "petugas_id" => "873313dd-863a-48f1-a09a-d113e26632b1",
            "image" => "udin.jpg",
            "last_login" => now(),
            "expiry_date" => now(),
            "created_at" => now(),
            'updated_at' => now()

          ];
        DB::table('users')->insert($users);
    }
}
