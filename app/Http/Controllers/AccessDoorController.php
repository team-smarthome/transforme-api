<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessDoorController extends Controller
{
    public function getDummyData(Request $request)
    {
        // Data dummy sebagai contoh
        $dummyData = [
            [
                "id" => 1,
                "positionX" => "bottom-[6%]",
                "positionY" => "left-[7%]",
                "nama" => "Access Door 1"
            ],
            [
                "id" => 2,
                "positionX" => "bottom-[6%]",
                "positionY" => "left-[94%]",
                "nama" => "Access Door 2"
            ],
            [
                "id" => 3,
                "positionX" => "bottom-[90%]",
                "positionY" => "left-[94%]",
                "nama" => "Access Door 3"
            ],
            [
                "id" => 4,
                "positionX" => "bottom-[90%]",
                "positionY" => "left-[5%]",
                "nama" => "Access Door 4"
            ],
            [
                "id" => 5,
                "positionX" => "bottom-[48%]",
                "positionY" => "left-[35%]",
                "nama" => "Access Door 5"
            ],
            [
                "id" => 6,
                "positionX" => "bottom-[48%]",
                "positionY" => "left-[87%]",
                "nama" => "Access Door 6"
            ],
             [
                "id" => 7,
                "positionX" => "bottom-[90%]",
                "positionY" => "left-[94%]",
                "nama" => "Access Door 7"
            ],
            [
                "id" => 8,
                "positionX" => "bottom-[90%]",
                "positionY" => "left-[5%]",
                "nama" => "Access Door 8"
            ],
            [
                "id" => 9,
                "positionX" => "bottom-[48%]",
                "positionY" => "left-[35%]",
                "nama" => "Access Door 9"
            ],
            [
                "id" => 10,
                "positionX" => "bottom-[48%]",
                "positionY" => "left-[87%]",
                "nama" => "Access Door 10"
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

