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
            StatusWbpKasusSeeder::class,
            JenisPidanaSeeder::class,
            KategoriPerkaraSeeder::class,
            JenisPerkaraSeeder::class,
            KasusSeeder::class,
            ZonaSeeder::class,
            GedungOtmilSeeder::class,
            LantaiOtmilSeeder::class,
            GedungLemasMilSeeder::class,
            LantaiLemasMilSeeder::class,
            RuanganOtmilSeeder::class,
            RuanganLemasMilSeeder::class,
            GelangSeeder::class,
            HunianWbpOtmilSeeder::class,
            HunianWbpLemasMilSeeder::class,
            WbpProfileSeeder::class,
            UserSeeder::class,
            UserLogSeeder::class,
            PengadilanMiliterSeeder::class,
            JenisPersidanganSeeder::class,
            SidangSeeder::class,
            DokumenPersidanganSeeder::class,
            SaksiSeeder::class,
            AhliSeeder::class,
            PivotSidangAhliSeeder::class,
            PivotSidangSaksiSeeder::class,
            OditurPenuntutSeeder::class,
            PivotSidangOditurSeeder::class,
            WbpPerkaraSeeder::class,
            OditurPenyidikSeeder::class,
            PenyidikanSeeder::class,
            DokumenBapSeeder::class,
            PivotKasusOditurSeeder::class,
            HistoriPenyidikanSeeder::class,
            TipeAsetSeeder::class,
            AsetSeeder::class,
            BarangBuktiKasusSeeder::class,
            GatewaySeeder::class,
            PintuAksesSeeder::class,
            KameraSeeder::class,
            AksesRuanganSeeder::class,
            PenugasanSeeder::class,
            ShiftSeeder::class,
            ScheduleSeeder::class,
            PetugasShiftSeeder::class,
            VersionSeeder::class,    
        ]);
    }
}
