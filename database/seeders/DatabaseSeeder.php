<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserRoleSeeder::class,
            PangkatSeeder::class,
            LokasiKesatuanSeeder::class,
            KesatuanSeeder::class,
            ProvinsiSeeder::class,
            KotaSeeder::class,
            AgamaSeeder::class,
            StatusKawinSeeder::class,
            PendidikanSeeder::class,
            BidangKeahlianSeeder::class,
            LokasiOtmilSeeder::class,
            LokasiLemasMilSeeder::class,
            GrupPetugasSeeder::class,
            MatraSeeder::class,
            PetugasSeeder::class,
            UserSeeder::class,
        ]);
    }
}
