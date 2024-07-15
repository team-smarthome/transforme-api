<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TVDashboardController extends Controller
{
    public function getDummyData(Request $request)
    {
        // Data dummy sebagai contoh
        $dummyData = [
            [
                "id" => 1,
                "positionX" => "bottom-[38%]",
                "positionY" => "left-[-10.5%]",
                "nama" => "Interactive TV 1"
            ],    
            [
                "id" => 2,
                "positionX" => "bottom-[40%]",
                "positionY" => "left-[-12.5%]",
                "nama" => "Interactive TV 2"
            ],   
        ];


        // Filter berdasarkan nama jika parameter nama tersedia
        if ($request->has('nama')) {
            $namaFilter = $request->input('nama');

            // Pastikan $namaFilter adalah array, bahkan jika hanya satu nilai yang diberikan
            if (!is_array($namaFilter)) {
                $namaFilter = [$namaFilter];
            }

            $dummyData = array_filter($dummyData, function ($item) use ($namaFilter) {
                return in_array($item['nama'], $namaFilter);
            });
        }

        $response = [
            "status" => "OK",
            "message" => "Successfully get Data",
            "records" => array_values($dummyData) // Reindex array setelah filter
        ];

        return response()->json($response);
    }
}



