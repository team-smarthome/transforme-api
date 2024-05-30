<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PetugasShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $petugasShift = [
            [
                'id' => 'b1b3b3b3-1f81-4329-982c-0c290077846d',
                'shift_id' => 'c5e99fed-d404-4c3e-a96b-9cfde0e341f5',
                'petugas_id' => '873313dd-863a-48f1-a09a-d113e26632b1',
                'schedule_id' => 'b1b3b3b3-1f81-4329-982c-0c290077846f',
                'status_kehadiran' => 1,
                'status_izin' => "Tidak",
                'penugasan_id' => 'b1b3b3b3-1f81-4329-982c-0c290077846a',
                'ruangan_otmil_id' => 'f6e62e45-498d-45a8-affd-e5e363c99442',
                'lokasi_otmil_id' => '890cc9b1-b01f-4d1f-9075-a6a96e851b25',
                'ruangan_lemasmil_id' => 'db10dd62-c048-44aa-a85e-9c29551704d2',
                'lokasi_lemasmil_id' => '48633be0-b005-4029-8bbb-293db9564ba0', 
                'status_pengganti' => "Tidak",
                'lembur' => 1,
                'keterangan_lembur' => 'Tidak',
                'created_at' => now(),
            ]
        ];

        DB::table('petugas_shift')->insert($petugasShift);
    }
}
