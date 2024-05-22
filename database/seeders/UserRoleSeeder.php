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
            ['id' => Str::uuid(), 'role_name' => 'superadmin', 'deskripsi_role' => 'Insert, Read, Update, Delete dan Hak Akses modifikasi User', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'role_name' => 'admin', 'deskripsi_role' => 'Insert, Read, Update, Delete', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'role_name' => 'operator', 'deskripsi_role' => 'Read', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('user_role')->insert($roles);
    }
}
