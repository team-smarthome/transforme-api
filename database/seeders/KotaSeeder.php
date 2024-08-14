<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use Carbon\Carbon;


class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = '{
            "kota": [
                {
                    "id" : "7a0373d7-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SIMEULUE",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a0375ae-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ACEH SINGKIL",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a037602-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ACEH SELATAN",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a037637-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ACEH TENGGARA",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a037666-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ACEH TIMUR",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a037692-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ACEH TENGAH",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a0376c3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ACEH BARAT",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a0376ec-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ACEH BESAR",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a03771e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PIDIE",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a037749-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BIREUEN",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a037773-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ACEH UTARA",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a03779a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ACEH BARAT DAYA",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a0377c4-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN GAYO LUES",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a0377e8-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ACEH TAMIANG",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a03780f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN NAGAN RAYA",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a037838-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ACEH JAYA",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a03785e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BENER MERIAH",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a037887-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PIDIE JAYA",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a0378b0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BANDA ACEH",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a0378e0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SABANG",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a03790c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA LANGSA",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a037934-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA LHOKSEUMAWE",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a03795c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SUBULUSSALAM",
                    "provinsi_id" : "a00fa162-5cd1-475e-ad81-03426a7f7952"
                },
                {
                    "id" : "7a037984-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN NIAS",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0379ae-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MANDAILING NATAL",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0379d5-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TAPANULI SELATAN",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0379fc-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TAPANULI TENGAH",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037a24-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TAPANULI UTARA",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037a4f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TOBA SAMOSIR",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037a76-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LABUHAN BATU",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037a9d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ASAHAN",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037ac3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SIMALUNGUN",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037af0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN DAIRI",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037b19-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KARO",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037b43-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN DELI SERDANG",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037b6b-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LANGKAT",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037b93-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN NIAS SELATAN",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037bba-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN HUMBANG HASUNDUTAN",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037cda-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PAKPAK BHARAT",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037d04-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SAMOSIR",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037d27-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SERDANG BEDAGAI",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037d4a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BATU BARA",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037d6d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PADANG LAWAS UTARA",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037d8f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PADANG LAWAS",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037df2-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LABUHAN BATU SELATAN",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037e17-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LABUHAN BATU UTARA",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037e3a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN NIAS UTARA",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037e61-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN NIAS BARAT",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037e81-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SIBOLGA",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037ea4-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA TANJUNG BALAI",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037ec6-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PEMATANG SIANTAR",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037ee6-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA TEBING TINGGI",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037f08-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA MEDAN",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037f2a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BINJAI",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037fd2-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PADANGSIDIMPUAN",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a037ff9-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA GUNUNGSITOLI",
                    "provinsi_id" : "e9fa8a27-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03801b-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KEPULAUAN MENTAWAI",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03803e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PESISIR SELATAN",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03805e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SOLOK",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03807e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SIJUNJUNG",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03809f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TANAH DATAR",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0380c1-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PADANG PARIAMAN",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0380e1-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN AGAM",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038102-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LIMA PULUH KOTA",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038124-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PASAMAN",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038146-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SOLOK SELATAN",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038169-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN DHARMASRAYA",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03818b-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PASAMAN BARAT",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0381b3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PADANG",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0381d5-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SOLOK",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0381f5-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SAWAH LUNTO",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038217-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PADANG PANJANG",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038238-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BUKITTINGGI",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038259-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PAYAKUMBUH",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03828d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PARIAMAN",
                    "provinsi_id" : "e9fa8a65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03832d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KUANTAN SINGINGI",
                    "provinsi_id" : "e9fa8a8e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038356-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN INDRAGIRI HULU",
                    "provinsi_id" : "e9fa8a8e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038377-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN INDRAGIRI HILIR",
                    "provinsi_id" : "e9fa8a8e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0383ab-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PELALAWAN",
                    "provinsi_id" : "e9fa8a8e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0383ce-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN S I A K",
                    "provinsi_id" : "e9fa8a8e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0383f0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KAMPAR",
                    "provinsi_id" : "e9fa8a8e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038414-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ROKAN HULU",
                    "provinsi_id" : "e9fa8a8e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038436-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BENGKALIS",
                    "provinsi_id" : "e9fa8a8e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038459-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ROKAN HILIR",
                    "provinsi_id" : "e9fa8a8e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03847d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KEPULAUAN MERANTI",
                    "provinsi_id" : "e9fa8a8e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0384a2-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PEKANBARU",
                    "provinsi_id" : "e9fa8a8e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0384c3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA D U M A I",
                    "provinsi_id" : "e9fa8a8e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0384e6-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KERINCI",
                    "provinsi_id" : "e9fa8ab4-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038508-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MERANGIN",
                    "provinsi_id" : "e9fa8ab4-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03852a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SAROLANGUN",
                    "provinsi_id" : "e9fa8ab4-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03854c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BATANG HARI",
                    "provinsi_id" : "e9fa8ab4-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03856c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MUARO JAMBI",
                    "provinsi_id" : "e9fa8ab4-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03858e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TANJUNG JABUNG TIMUR",
                    "provinsi_id" : "e9fa8ab4-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0385b0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TANJUNG JABUNG BARAT",
                    "provinsi_id" : "e9fa8ab4-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0385d1-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TEBO",
                    "provinsi_id" : "e9fa8ab4-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0385f2-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BUNGO",
                    "provinsi_id" : "e9fa8ab4-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038613-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA JAMBI",
                    "provinsi_id" : "e9fa8ab4-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038633-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SUNGAI PENUH",
                    "provinsi_id" : "e9fa8ab4-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0386ae-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN OGAN KOMERING ULU",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0386d3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN OGAN KOMERING ILIR",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0386f5-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MUARA ENIM",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038715-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LAHAT",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038735-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MUSI RAWAS",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038756-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MUSI BANYUASIN",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038779-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANYU ASIN",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03879a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN OGAN KOMERING ULU SELATAN",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0387bc-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN OGAN KOMERING ULU TIMUR",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0387de-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN OGAN ILIR",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038802-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN EMPAT LAWANG",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038822-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PENUKAL ABAB LEMATANG ILIR",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038843-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MUSI RAWAS UTARA",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038863-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PALEMBANG",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038883-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PRABUMULIH",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0388a4-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PAGAR ALAM",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0388c4-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA LUBUKLINGGAU",
                    "provinsi_id" : "e9fa8ad8-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0388e3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BENGKULU SELATAN",
                    "provinsi_id" : "e9fa8afd-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038903-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN REJANG LEBONG",
                    "provinsi_id" : "e9fa8afd-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038940-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BENGKULU UTARA",
                    "provinsi_id" : "e9fa8afd-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038962-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KAUR",
                    "provinsi_id" : "e9fa8afd-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038982-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SELUMA",
                    "provinsi_id" : "e9fa8afd-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0389a3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MUKOMUKO",
                    "provinsi_id" : "e9fa8afd-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0389c4-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LEBONG",
                    "provinsi_id" : "e9fa8afd-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038a4b-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KEPAHIANG",
                    "provinsi_id" : "e9fa8afd-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038a70-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BENGKULU TENGAH",
                    "provinsi_id" : "e9fa8afd-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038a95-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BENGKULU",
                    "provinsi_id" : "e9fa8afd-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038ab8-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LAMPUNG BARAT",
                    "provinsi_id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038adb-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TANGGAMUS",
                    "provinsi_id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038afe-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LAMPUNG SELATAN",
                    "provinsi_id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038bbe-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LAMPUNG TIMUR",
                    "provinsi_id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038bed-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LAMPUNG TENGAH",
                    "provinsi_id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038c11-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LAMPUNG UTARA",
                    "provinsi_id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a038c34-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN WAY KANAN",
                    "provinsi_id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039162-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TULANGBAWANG",
                    "provinsi_id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0391f2-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PESAWARAN",
                    "provinsi_id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039222-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PRINGSEWU",
                    "provinsi_id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039258-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MESUJI",
                    "provinsi_id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03927b-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TULANG BAWANG BARAT",
                    "provinsi_id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03929f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PESISIR BARAT",
                    "provinsi_id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0392c1-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BANDAR LAMPUNG",
                    "provinsi_id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0392df-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA METRO",
                    "provinsi_id" : "e9fa8b1e-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0392fe-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANGKA",
                    "provinsi_id" : "e9fa8b46-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03931d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BELITUNG",
                    "provinsi_id" : "e9fa8b46-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03933d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANGKA BARAT",
                    "provinsi_id" : "e9fa8b46-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03935d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANGKA TENGAH",
                    "provinsi_id" : "e9fa8b46-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039379-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANGKA SELATAN",
                    "provinsi_id" : "e9fa8b46-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03939a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BELITUNG TIMUR",
                    "provinsi_id" : "e9fa8b46-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0393b7-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PANGKAL PINANG",
                    "provinsi_id" : "e9fa8b46-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0393d6-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KARIMUN",
                    "provinsi_id" : "e9fa8b6b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03949e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BINTAN",
                    "provinsi_id" : "e9fa8b6b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0394c1-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN NATUNA",
                    "provinsi_id" : "e9fa8b6b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0394e2-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LINGGA",
                    "provinsi_id" : "e9fa8b6b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039500-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KEPULAUAN ANAMBAS",
                    "provinsi_id" : "e9fa8b6b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039523-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA B A T A M",
                    "provinsi_id" : "e9fa8b6b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039544-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA TANJUNG PINANG",
                    "provinsi_id" : "e9fa8b6b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039562-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KEPULAUAN SERIBU",
                    "provinsi_id" : "bd304f3c-b18d-4982-8e41-1a3606bdf06e"
                },
                {
                    "id" : "847b7af8-f2cc-4b62-96a0-22cc3d1b2511",
                    "nama_kota" : "KOTA JAKARTA SELATAN",
                    "provinsi_id" : "bd304f3c-b18d-4982-8e41-1a3606bdf06e"
                },
                {
                    "id" : "e31c11f8-0e47-401e-a326-688013f9b483",
                    "nama_kota" : "KOTA JAKARTA TIMUR",
                    "provinsi_id" : "bd304f3c-b18d-4982-8e41-1a3606bdf06e"
                },
                {
                    "id" : "712edf09-2a39-4515-aff8-531ed9f69523",
                    "nama_kota" : "KOTA JAKARTA PUSAT",
                    "provinsi_id" : "bd304f3c-b18d-4982-8e41-1a3606bdf06e"
                },
                {
                    "id" : "a546390a-8024-4300-b024-48102874b882",
                    "nama_kota" : "KOTA JAKARTA BARAT",
                    "provinsi_id" : "bd304f3c-b18d-4982-8e41-1a3606bdf06e"
                },
                {
                    "id" : "20256ac2-caa3-4e7b-802b-eba531b9cf5c",
                    "nama_kota" : "KOTA JAKARTA UTARA",
                    "provinsi_id" : "bd304f3c-b18d-4982-8e41-1a3606bdf06e"
                },
                {
                    "id" : "7a039619-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BOGOR",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039639-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SUKABUMI",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039656-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN CIANJUR",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039672-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANDUNG",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039691-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN GARUT",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0396ae-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TASIKMALAYA",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0396cd-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN CIAMIS",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0396ea-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KUNINGAN",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039708-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN CIREBON",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039727-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAJALENGKA",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039745-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SUMEDANG",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039762-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN INDRAMAYU",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039782-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SUBANG",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0397a0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PURWAKARTA",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03985d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KARAWANG",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03987f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BEKASI",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03989d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANDUNG BARAT",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0398be-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PANGANDARAN",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0398db-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BOGOR",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0398f9-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SUKABUMI",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039919-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BANDUNG",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039938-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA CIREBON",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039957-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BEKASI",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039974-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA DEPOK",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039991-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA CIMAHI",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0399af-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA TASIKMALAYA",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0399cd-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BANJAR",
                    "provinsi_id" : "e9fa8baa-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a0399eb-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN CILACAP",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039a0a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANYUMAS",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039a27-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PURBALINGGA",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039a44-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANJARNEGARA",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039a64-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KEBUMEN",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039a82-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PURWOREJO",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039aa3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN WONOSOBO",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039ac2-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAGELANG",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039ae0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BOYOLALI",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039b02-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KLATEN",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039b20-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SUKOHARJO",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039bed-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN WONOGIRI",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039c33-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KARANGANYAR",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039d37-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SRAGEN",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039d61-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN GROBOGAN",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039d83-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BLORA",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039da2-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN REMBANG",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039dc0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PATI",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039ddf-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KUDUS",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039dfe-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN JEPARA",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039e1b-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN DEMAK",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039e3a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SEMARANG",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039e59-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TEMANGGUNG",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039e77-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KENDAL",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039e96-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BATANG",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039eb3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PEKALONGAN",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039ed1-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PEMALANG",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039ef0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TEGAL",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039f0d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BREBES",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039f2d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA MAGELANG",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039f4c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SURAKARTA",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039f6a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SALATIGA",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039f89-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SEMARANG",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039fa6-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PEKALONGAN",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039fc3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA TEGAL",
                    "provinsi_id" : "e9fa8bcb-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039fe1-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KULON PROGO",
                    "provinsi_id" : "e9fa8be9-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a039fff-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANTUL",
                    "provinsi_id" : "e9fa8be9-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a01c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN GUNUNG KIDUL",
                    "provinsi_id" : "e9fa8be9-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a03d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SLEMAN",
                    "provinsi_id" : "e9fa8be9-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a05a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA YOGYAKARTA",
                    "provinsi_id" : "e9fa8be9-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a078-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PACITAN",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a095-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PONOROGO",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a0b4-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TRENGGALEK",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a0d3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TULUNGAGUNG",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a255-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BLITAR",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a27a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KEDIRI",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a298-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MALANG",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a2b6-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LUMAJANG",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a2d6-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN JEMBER",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a2f4-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANYUWANGI",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a312-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BONDOWOSO",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a332-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SITUBONDO",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a350-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PROBOLINGGO",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a36d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PASURUAN",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a38d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SIDOARJO",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a3ab-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MOJOKERTO",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a3ca-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN JOMBANG",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a3e7-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN NGANJUK",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a405-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MADIUN",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a424-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAGETAN",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a442-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN NGAWI",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a45f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BOJONEGORO",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a47e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TUBAN",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a49c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LAMONGAN",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a4bb-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN GRESIK",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a4d9-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANGKALAN",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a4f6-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SAMPANG",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a515-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PAMEKASAN",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a532-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SUMENEP",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a54f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA KEDIRI",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a571-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BLITAR",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a590-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA MALANG",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a5ad-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PROBOLINGGO",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a5cc-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PASURUAN",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a5ea-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA MOJOKERTO",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a609-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA MADIUN",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a626-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SURABAYA",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a644-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BATU",
                    "provinsi_id" : "e9fa8c0a-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a664-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PANDEGLANG",
                    "provinsi_id" : "e9fa8c28-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a682-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LEBAK",
                    "provinsi_id" : "e9fa8c28-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a69f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TANGERANG",
                    "provinsi_id" : "e9fa8c28-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a6bd-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SERANG",
                    "provinsi_id" : "e9fa8c28-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a6db-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN CILEGON",
                    "provinsi_id" : "e9fa8c28-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a6fa-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA TANGERANG",
                    "provinsi_id" : "e9fa8c28-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a717-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA CILEGON",
                    "provinsi_id" : "e9fa8c28-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a734-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SERANG",
                    "provinsi_id" : "e9fa8c28-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a753-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA TANGSEL",
                    "provinsi_id" : "e9fa8c28-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a770-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN JEMBRANA",
                    "provinsi_id" : "e9fa8c47-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a8c1-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TABANAN",
                    "provinsi_id" : "e9fa8c47-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a8e9-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BADUNG",
                    "provinsi_id" : "e9fa8c47-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a908-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN GIANYAR",
                    "provinsi_id" : "e9fa8c47-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a928-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KLUNGKUNG",
                    "provinsi_id" : "e9fa8c47-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a946-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANGLI",
                    "provinsi_id" : "e9fa8c47-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a963-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KARANGASEM",
                    "provinsi_id" : "e9fa8c47-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a982-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BULELENG",
                    "provinsi_id" : "e9fa8c47-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a99f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA DENPASAR",
                    "provinsi_id" : "e9fa8c47-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a9bc-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LOMBOK BARAT",
                    "provinsi_id" : "e9fa8c6d-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a9dd-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LOMBOK TENGAH",
                    "provinsi_id" : "e9fa8c6d-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03a9fd-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LOMBOK TIMUR",
                    "provinsi_id" : "e9fa8c6d-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03aa1b-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SUMBAWA",
                    "provinsi_id" : "e9fa8c6d-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03aa39-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN DOMPU",
                    "provinsi_id" : "e9fa8c6d-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03aa56-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BIMA",
                    "provinsi_id" : "e9fa8c6d-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03aa76-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SUMBAWA BARAT",
                    "provinsi_id" : "e9fa8c6d-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03aa94-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LOMBOK UTARA",
                    "provinsi_id" : "e9fa8c6d-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03aab2-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA MATARAM",
                    "provinsi_id" : "e9fa8c6d-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03aad0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BIMA",
                    "provinsi_id" : "e9fa8c6d-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03aaee-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SUMBA TIMUR",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ab0e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SUMBA BARAT DAYA",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ab2d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN NAGEKEO",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ab4a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MANGGARAI",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ab6a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ROTE NDAO",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ab88-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MANGGARAI BARAT",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03aba6-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SIPIONG",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03abc5-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KUPANG",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03abe4-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TIMOR TENGAH SELATAN",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ac04-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TIMOR TENGAH UTARA",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ac23-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BELU",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ac40-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ALOR",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ac5f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LEMBATA",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ac7c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN FLORES TIMUR",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ac9a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SIKKA",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03acb8-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ENDE",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03acd6-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN NGADA",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03acf5-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MANGGARAI TIMUR",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ad12-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SUMBA TIMUR",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ad30-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SUMBA BARAT",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ad50-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KUPANG",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ad6d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TIMOR TENGAH SELATAN",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ad8c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TIMOR TENGAH UTARA",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03aec8-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BELU",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03aeec-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ALOR",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03af0c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LEMBATA",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03af2a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN FLORES TIMUR",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03af48-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SIKKA",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03af68-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ENDE",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03af86-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN NGADA",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03afa5-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MANGGARAI TIMUR",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03afc2-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN NAGA",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03afdf-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN FLORES SELATAN",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03affe-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KUPANG",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b01c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA KUPANG",
                    "provinsi_id" : "e9fa8cfe-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b03a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SAMBAS",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b0f7-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BENGKAYANG",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b117-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LANDAK",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b136-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MEMPAWAH",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b154-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SANGGAU",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b20f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KETAPANG",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b249-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SINTANG",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b271-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KAPUAS HULU",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b29b-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SEKADAU",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b2bb-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MELAWI",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b2dc-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KAYONG UTARA",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b2fb-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KUBU RAYA",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b31a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PONTIANAK",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b33a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SINGKAWANG",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b35a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PONTIANAK",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b37d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SINGKAWANG",
                    "provinsi_id" : "e9fa8d25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b39f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KOTAWARINGIN BARAT",
                    "provinsi_id" : "e9fa8d45-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b3bc-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KOTAWARINGIN TIMUR",
                    "provinsi_id" : "e9fa8d45-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b3db-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KAPUAS",
                    "provinsi_id" : "e9fa8d45-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b3f9-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BARITO SELATAN",
                    "provinsi_id" : "e9fa8d45-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b419-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BARITO UTARA",
                    "provinsi_id" : "e9fa8d45-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b438-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SUKAMARA",
                    "provinsi_id" : "e9fa8d45-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b455-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LAMANDAU",
                    "provinsi_id" : "e9fa8d45-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b471-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SERUYAN",
                    "provinsi_id" : "e9fa8d45-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b491-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KATINGAN",
                    "provinsi_id" : "e9fa8d45-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b8e1-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PULANG PISAU",
                    "provinsi_id" : "e9fa8d45-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03b90e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN GUNUNG MAS",
                    "provinsi_id" : "e9fa8d45-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03baaa-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BARITO TIMUR",
                    "provinsi_id" : "e9fa8d45-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bad2-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MURUNG RAYA",
                    "provinsi_id" : "e9fa8d45-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03baf0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PULAU HULU",
                    "provinsi_id" : "e9fa8d45-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bb0f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TABALONG",
                    "provinsi_id" : "e9fa8d65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bb2c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TANAH BUMBU",
                    "provinsi_id" : "e9fa8d65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bb4a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BALANGAN",
                    "provinsi_id" : "e9fa8d65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bb69-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KOTA BARU",
                    "provinsi_id" : "e9fa8d65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bb87-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BANJAR BARU",
                    "provinsi_id" : "e9fa8d65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bba5-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BANJARMASIN",
                    "provinsi_id" : "e9fa8d65-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bbc3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PASER",
                    "provinsi_id" : "e9fa8d84-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bbe0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KUTAI KARTANEGARA",
                    "provinsi_id" : "e9fa8d84-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bbff-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BERAU",
                    "provinsi_id" : "e9fa8d84-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bc1c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KUTAI BARAT",
                    "provinsi_id" : "e9fa8d84-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bc3a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KUTAI TIMUR",
                    "provinsi_id" : "e9fa8d84-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bc58-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PENAJAM PASER UTARA",
                    "provinsi_id" : "e9fa8d84-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bc76-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TANA TIDUNG",
                    "provinsi_id" : "e9fa8d84-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bc93-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BULUNGAN",
                    "provinsi_id" : "e9fa8d84-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bcb2-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN NUNUKAN",
                    "provinsi_id" : "e9fa8d84-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bccf-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MALINAU",
                    "provinsi_id" : "e9fa8d84-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bced-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TARAKAN",
                    "provinsi_id" : "e9fa8d84-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bd0a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BALIKPAPAN",
                    "provinsi_id" : "e9fa8d84-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bd28-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SAMARINDA",
                    "provinsi_id" : "e9fa8d84-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bd8b-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BONTANG",
                    "provinsi_id" : "e9fa8d84-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bdac-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BOLAANG MONGONDOW",
                    "provinsi_id" : "e9fa8dc1-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bdcb-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MINAHASA",
                    "provinsi_id" : "e9fa8dc1-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bdea-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KEPULAUAN SANGIHE",
                    "provinsi_id" : "e9fa8dc1-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03be08-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KEPULAUAN TALAUD",
                    "provinsi_id" : "e9fa8dc1-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03be28-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MINAHASA SELATAN",
                    "provinsi_id" : "e9fa8dc1-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03be46-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MINAHASA UTARA",
                    "provinsi_id" : "e9fa8dc1-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03be67-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MINAHASA TENGGARA",
                    "provinsi_id" : "e9fa8dc1-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03be88-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BOLAANG MONGONDOW UTARA",
                    "provinsi_id" : "e9fa8dc1-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bea6-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SIAU TAGULANDANG BIARO",
                    "provinsi_id" : "e9fa8dc1-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bec5-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MINAHASA TENGGARA UTARA",
                    "provinsi_id" : "e9fa8dc1-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bee3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA MANADO",
                    "provinsi_id" : "e9fa8dc1-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bf00-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BITUNG",
                    "provinsi_id" : "e9fa8dc1-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bf1e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA TOMOHON",
                    "provinsi_id" : "e9fa8dc1-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bf3b-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA KOTAMOBAGU",
                    "provinsi_id" : "e9fa8dc1-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bf59-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANGGAI KEPULAUAN",
                    "provinsi_id" : "e9fa8de3-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bf76-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANGGAI",
                    "provinsi_id" : "e9fa8de3-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bf93-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MOROWALI",
                    "provinsi_id" : "e9fa8de3-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bfb2-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN POSO",
                    "provinsi_id" : "e9fa8de3-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bfd0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN DONGGALA",
                    "provinsi_id" : "e9fa8de3-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03bfed-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TOLI-TOLI",
                    "provinsi_id" : "e9fa8de3-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c00c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BUOL",
                    "provinsi_id" : "e9fa8de3-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c028-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PARIGI MOUTONG",
                    "provinsi_id" : "e9fa8de3-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c046-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TOJO UNA-UNA",
                    "provinsi_id" : "e9fa8de3-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c1af-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SIGI",
                    "provinsi_id" : "e9fa8de3-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c1d1-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANGGAI LAUT",
                    "provinsi_id" : "e9fa8de3-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c1f1-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MOROWALI UTARA",
                    "provinsi_id" : "e9fa8de3-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c210-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MOROWALI BARAT",
                    "provinsi_id" : "e9fa8de3-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c22f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PALU",
                    "provinsi_id" : "e9fa8de3-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c24f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KEPULAUAN SELAYAR",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c26d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BULUKUMBA",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c28c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BANTAENG",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c2ab-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN JENEPONTO",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c2c8-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TAKALAR",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c2e7-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN GOWA",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c304-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SINJAI",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c322-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAROS",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c33f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PANGKAJENE KEPULAUAN",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c35c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BARRU",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c37a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BONE",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c396-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SOPPENG",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c3b3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN WAJO",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c3d0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SIDENRENG RAPPANG",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c3ee-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PINRANG",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c40a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ENREKANG",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c428-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LUWU",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c444-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TANA TORAJA",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c464-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN N A N N I",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c482-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KEPULAUAN SELAYAR",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c4a3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA MAKASSAR",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c4c3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PARE-PARE",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c4e2-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA PALOPO",
                    "provinsi_id" : "e9fa8e04-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c500-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BUTON",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c51e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MUNA",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c53a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KONAWE",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c559-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KOLAKA",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c576-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KONAWE SELATAN",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c594-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BOMBANA",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c5b3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN WAKATOBI",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c5d1-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KOLAKA UTARA",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c5ee-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BUTON UTARA",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c60d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KONAWE UTARA",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c62a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KOLAKA TIMUR",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c64a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KONAWE KEPULAUAN",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c668-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MUNA BARAT",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c685-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BUTON TENGAH",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c812-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BUTON SELATAN",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c837-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KONAWE SELATAN",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c855-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BOMBANA",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c874-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN WAKATOBI",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c892-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KOLAKA UTARA",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c8b1-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BUTON UTARA",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c8ce-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KONAWE UTARA",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c8eb-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KOLAKA TIMUR",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c909-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KONAWE KEPULAUAN",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c928-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MUNA BARAT",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c946-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BUTON TENGAH",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c963-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BUTON SELATAN",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c97f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA KENDARI",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c9a0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA BAU-BAU",
                    "provinsi_id" : "e9fa8e25-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c9be-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BOALEMO",
                    "provinsi_id" : "e9fa8e46-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c9da-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN GORONTALO",
                    "provinsi_id" : "e9fa8e46-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03c9f9-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN POHUWATO",
                    "provinsi_id" : "e9fa8e46-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ca16-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BONE BOLANGO",
                    "provinsi_id" : "e9fa8e46-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ca34-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN GORONTALO UTARA",
                    "provinsi_id" : "e9fa8e46-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ca52-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA GORONTALO",
                    "provinsi_id" : "e9fa8e46-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ca6f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAJENE",
                    "provinsi_id" : "e9fa8f0b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ca8f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN POLEWALI MANDAR",
                    "provinsi_id" : "e9fa8f0b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cb46-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAJENE",
                    "provinsi_id" : "e9fa8f0b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cb82-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN POLEWALI MANDAR",
                    "provinsi_id" : "e9fa8f0b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cbac-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAMASA",
                    "provinsi_id" : "e9fa8f0b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cbd4-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAMUJU UTARA",
                    "provinsi_id" : "e9fa8f0b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cbf4-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAMUJU",
                    "provinsi_id" : "e9fa8f0b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cc10-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAMUJU TENGAH",
                    "provinsi_id" : "e9fa8f0b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cc31-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAMUJU TENGGARA",
                    "provinsi_id" : "e9fa8f0b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cc51-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAMUJU UTARA",
                    "provinsi_id" : "e9fa8f0b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cc6e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAMUJU TENGAH",
                    "provinsi_id" : "e9fa8f0b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cc8c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAMUJU TENGGARA",
                    "provinsi_id" : "e9fa8f0b-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ccaa-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MALUKU TENGAH",
                    "provinsi_id" : "e9fa8f35-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ccc9-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MALUKU TENGGARA",
                    "provinsi_id" : "e9fa8f35-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cce7-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MALUKU TENGGARA BARAT",
                    "provinsi_id" : "e9fa8f35-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cd05-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BURU",
                    "provinsi_id" : "e9fa8f35-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cd23-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KEPULAUAN ARU",
                    "provinsi_id" : "e9fa8f35-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cd41-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SERAM BAGIAN BARAT",
                    "provinsi_id" : "e9fa8f35-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cd60-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SERAM BAGIAN TIMUR",
                    "provinsi_id" : "e9fa8f35-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cd7d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MALUKU BARAT DAYA",
                    "provinsi_id" : "e9fa8f35-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cd9b-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BURU SELATAN",
                    "provinsi_id" : "e9fa8f35-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cdb9-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA AMBON",
                    "provinsi_id" : "e9fa8f35-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cdd7-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA TUAL",
                    "provinsi_id" : "e9fa8f35-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cdf5-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN HALMAHERA BARAT",
                    "provinsi_id" : "e9fa8f54-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ce14-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN HALMAHERA TENGAH",
                    "provinsi_id" : "e9fa8f54-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03ce31-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN HALMAHERA UTARA",
                    "provinsi_id" : "e9fa8f54-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03cffb-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN HALMAHERA SELATAN",
                    "provinsi_id" : "e9fa8f54-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d021-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KEPULAUAN SULA",
                    "provinsi_id" : "e9fa8f54-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d040-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN HALMAHERA TIMUR",
                    "provinsi_id" : "e9fa8f54-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d05f-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PULAU MOROTAI",
                    "provinsi_id" : "e9fa8f54-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d07e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA TERNATE",
                    "provinsi_id" : "e9fa8f54-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d09d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA TIDORE KEPULAUAN",
                    "provinsi_id" : "e9fa8f54-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d0bc-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SOFIFI",
                    "provinsi_id" : "e9fa8f54-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d0df-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN FAKFAK",
                    "provinsi_id" : "e9fa8f76-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d0ff-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KAIMANA",
                    "provinsi_id" : "e9fa8f76-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d11c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TELUK WONDAMA",
                    "provinsi_id" : "e9fa8f76-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d139-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TELUK BINTUNI",
                    "provinsi_id" : "e9fa8f76-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d158-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MANOKWARI",
                    "provinsi_id" : "e9fa8f76-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d177-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SORONG SELATAN",
                    "provinsi_id" : "e9fa8f76-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d195-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SORONG",
                    "provinsi_id" : "e9fa8f76-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d1b1-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN RAJA AMPAT",
                    "provinsi_id" : "e9fa8f76-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d1cf-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TAMBRAUW",
                    "provinsi_id" : "e9fa8f76-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d1ee-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAYBRAT",
                    "provinsi_id" : "e9fa8f76-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d20c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MANOKWARI SELATAN",
                    "provinsi_id" : "e9fa8f76-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d22a-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PEGUNUNGAN ARFAK",
                    "provinsi_id" : "e9fa8f76-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d249-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA SORONG",
                    "provinsi_id" : "e9fa8f76-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d269-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MERAUKE",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d289-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN JAYAWIJAYA",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d2a8-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN JAYAPURA",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d2c5-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN NABIRE",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d2e3-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KEPULAUAN YAPEN",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d300-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BIAK NUMFOR",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d31e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PANIAI",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d33b-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PUNCAK JAYA",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d358-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MIMIKA",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d375-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN BOVEN DIGOEL",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d393-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAPPI",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d3b0-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN ASMAT",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d3ce-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN YAHUKIMO",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d3eb-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PEGUNUNGAN BINTANG",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d409-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN TOLIKARA",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d426-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SARMI",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d442-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN KEEROM",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d460-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN WAROPEN",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d47d-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN SUPIORI",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d499-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAMBERAMO RAYA",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d4b9-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN NDUGA",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d4d7-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN LANNY JAYA",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d4f6-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN MAMBERAMO TENGAH",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d514-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN YALIMO",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d531-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN PUNCAK",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d550-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN DOGIYAI",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d56e-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN INTAN JAYA",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d58c-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KABUPATEN DEIYAI",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                },
                {
                    "id" : "7a03d5ac-626f-11ee-b769-0278ea03989a",
                    "nama_kota" : "KOTA JAYAPURA",
                    "provinsi_id" : "e9fa8f94-5931-11ee-968b-025a4b43e6ba"
                }
            ]
        }';
        
        $kotaArray = json_decode($json, true)['kota'];
        
        foreach ($kotaArray as &$provinsi) {
            $provinsi['created_at'] = Carbon::now();
        }
        
        DB::table('kota')->insert($kotaArray);
    }
}
