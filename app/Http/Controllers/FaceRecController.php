<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaceRecController extends Controller
{
    public function getDummyData(Request $request)
    {
        // Data dummy sebagai contoh
        $dummyData = [
            [
                "id" => 1,
                "positionX" => "bottom-[48%]",
                "positionY" => "left-[-10%]",
                "nama" => "Face Recognition 1"
            ],    
            [
                "id" => 2,
                "positionX" => "bottom-[58%]",
                "positionY" => "left-[-20%]",
                "nama" => "Face Recognition 2"
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

