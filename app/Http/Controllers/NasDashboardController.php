<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NasDashboardController extends Controller
{
    public function getDummyData(Request $request)
    {
        // Data dummy sebagai contoh
        $dummyData = [
            [
                "id" => 1,
                "positionX" => "bottom-[88%]",
                "positionY" => "left-[19%]",
                "nama" => "Joyvision 1",
                "ruangan" => "Kantor 1"
            ],    
            [
                "id" => 2,
                "positionX" => "bottom-[9%]",
                "positionY" =>  "left-[19%]",
                "nama" => "Joyvision 2",
                "ruangan" => "Kantor 2"
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




