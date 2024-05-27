<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id' => "f1943be9-e062-4815-9a1c-613b1b2260e2", 'role_name' => 'superadmin', 'deskripsi_role' => 'Insert, Read, Update, Delete dan Hak Akses modifikasi User', 'created_at' => now(), 'updated_at' => now()],
            ['id' => "e545a4b6-5813-469f-bcb6-dcddda960ccd", 'role_name' => 'admin', 'deskripsi_role' => 'Insert, Read, Update, Delete', 'created_at' => now(), 'updated_at' => now()],
            ['id' => "85117f63-0bbc-4cce-b023-28e270356b94", 'role_name' => 'operator', 'deskripsi_role' => 'Read', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('user_role')->insert($roles);
    }
}
