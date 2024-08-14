<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = '{
            "provinsi": [
                {
                    "id" : "a00fa162-5cd1-475e-ad81-03426a7f7952",
                    "nama_provinsi" : "ACEH"
                },
                {
                    "id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "SUMATERA UTARA"
                },
                {
                    "id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "SUMATERA BARAT"
                },
                {
                    "id" : "e9fa8a8e-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "RIAU"
                },
                {
                    "id" : "e9fa8ab4-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "JAMBI"
                },
                {
                    "id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "SUMATERA SELATAN"
                },
                {
                    "id" : "e9fa8afd-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "BENGKULU"
                },
                {
                    "id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "LAMPUNG"
                },
                {
                    "id" : "e9fa8b46-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "KEPULAUAN BANGKA BELITUNG"
                },
                {
                    "id" : "e9fa8b6b-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "KEPULAUAN RIAU"
                },
                {
                    "id" : "bd304f3c-b18d-4982-8e41-1a3606bdf06e",
                    "nama_provinsi" : "DKI JAKARTA"
                },
                {
                    "id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "JAWA BARAT"
                },
                {
                    "id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "JAWA TENGAH"
                },
                {
                    "id" : "e9fa8be9-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "DI YOGYAKARTA"
                },
                {
                    "id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "JAWA TIMUR"
                },
                {
                    "id" : "e9fa8c28-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "BANTEN"
                },
                {
                    "id" : "e9fa8c47-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "BALI"
                },
                {
                    "id" : "e9fa8c6d-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "NUSA TENGGARA BARAT"
                },
                {
                    "id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "NUSA TENGGARA TIMUR"
                },
                {
                    "id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "KALIMANTAN BARAT"
                },
                {
                    "id" : "e9fa8d45-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "KALIMANTAN TENGAH"
                },
                {
                    "id" : "e9fa8d65-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "KALIMANTAN SELATAN"
                },
                {
                    "id" : "e9fa8d84-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "KALIMANTAN TIMUR"
                },
                {
                    "id" : "e9fa8da2-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "KALIMANTAN UTARA"
                },
                {
                    "id" : "e9fa8dc1-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "SULAWESI UTARA"
                },
                {
                    "id" : "e9fa8de3-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "SULAWESI TENGAH"
                },
                {
                    "id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "SULAWESI SELATAN"
                },
                {
                    "id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "SULAWESI TENGGARA"
                },
                {
                    "id" : "e9fa8e46-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "GORONTALO"
                },
                {
                    "id" : "e9fa8f0b-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "SULAWESI BARAT"
                },
                {
                    "id" : "e9fa8f35-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "MALUKU"
                },
                {
                    "id" : "e9fa8f54-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "MALUKU UTARA"
                },
                {
                    "id" : "e9fa8f76-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "PAPUA BARAT"
                },
                {
                    "id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba",
                    "nama_provinsi" : "PAPUA"
                }
            ]
        }';
        
        $provinsiArray = json_decode($json, true)['provinsi'];
        
        foreach ($provinsiArray as &$provinsi) {
            $provinsi['created_at'] = Carbon::now();
        }
        
        DB::table('provinsi')->insert($provinsiArray);
    }
}
