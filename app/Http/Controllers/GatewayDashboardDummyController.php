<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GatewayDashboardDummyController extends Controller
{
    public function getDummyData(Request $request)
    {
        // Data dummy sebagai contoh
        $dummyData = [
            [
                "id" => 1,
                "positionX" => "left-[37.5%]",
                "positionY" => "bottom-[68.5%]",
                "nama" => "DynaMax 1"
            ],
            [
                "id" => 2,
                "positionX" => "left-[58.5%]",
                "positionY" => "bottom-[58%]",
                "nama" => "DynaMax 2"
            ],
            [
                "id" => 3,
                "positionX" => "left-[37.5%]",
                "positionY" => "bottom-[37%]",
                "nama" => "DynaMax 3"
            ],
            [
                "id" => 4,
                "positionX" => "left-[58.5%]",
                "positionY" => "bottom-[28%]",
                "nama" => "DynaMax 4"
            ],
            [
                "id" => 5,
                "positionX" => "left-[7.5%]",
                "positionY" => "bottom-[94%]",
                "nama" => "DynaMax 5"
            ],
            [
                "id" => 6,
                "positionX" => "left-[31%]",
                "positionY" => "bottom-[84.5%]",
                "nama" => "DynaMax 6"
            ],
            [
                "id" => 7,
                "positionX" => "left-[7.5%]",
                "positionY" => "bottom-[14.5%]",
                "nama" => "DynaMax 7"
            ],
            [
                "id" => 8,
                "positionX" => "left-[31%]",
                "positionY" => "bottom-[5%]",
                "nama" => "DynaMax 8"
            ],
            [
                "id" => 9,
                "positionX" => "left-[52%]",
                "positionY" => "bottom-[94%]",
                "nama" => "DynaMax 9"
            ],
            [
                "id" => 10,
                "positionX" => "left-[75.5%]",
                "positionY" => "bottom-[85%]",
                "nama" => "DynaMax 10"
            ],
            [
                "id" => 11,
                "positionX" => "left-[52%]",
                "positionY" => "bottom-[15%]",
                "nama" => "DynaMax 11"
            ],
            [
                "id" => 12,
                "positionX" => "left-[75.5%]",
                "positionY" => "bottom-[5%]",
                "nama" => "DynaMax 12"
            ],
            [
                "id" => 13,
                "positionX" => "left-[-1.5%]",
                "positionY" => "bottom-[89%]",
                "nama" => "DynaMax 13"
            ],
            [
                "id" => 14,
                "positionX" => "left-[1%]",
                "positionY" => "bottom-[75%]",
                "nama" => "DynaMax 14"
            ],
            [
                "id" => 15,
                "positionX" => "left-[-2.5%]",
                "positionY" => "bottom-[62%]",
                "nama" => "DynaMax 15"
            ],
            [
                "id" => 16,
                "positionX" => "left-[0%]",
                "positionY" => "bottom-[34%]",
                "nama" => "DynaMax 16"
            ],
            [
                "id" => 17,
                "positionX" => "left-[-1.5%]",
                "positionY" => "bottom-[26%]",
                "nama" => "DynaMax 17"
            ],
            [
                "id" => 18,
                "positionX" => "left-[1%]",
                "positionY" => "bottom-[11%]",
                "nama" => "DynaMax 18"
            ],
            [
                "id" => 19,
                "positionX" => "left-[-12.5%]",
                "positionY" => "bottom-[88.5%]",
                "nama" => "DynaMax 19"
            ],
            [
                "id" => 20,
                "positionX" => "left-[-10%]",
                "positionY" => "bottom-[76%]",
                "nama" => "DynaMax 20"
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
