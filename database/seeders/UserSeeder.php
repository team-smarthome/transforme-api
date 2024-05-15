<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user =
      [
        [
          "username" => "123456789012345678",
          "password" => Hash::make("admin123")
        ],
        [
          "username" => "123123123123123123",
          "password" => Hash::make("admin123")
        ],
        [
          "username" => "123456123456123456",
          "password" => Hash::make("admin123")
        ],
        [
          "username" => "654321654321654321",
          "password" => Hash::make("admin123")
        ],
      ];

    foreach ($user as $user)
      User::create($user);
  }
}
