<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DummyCameraIndoormap extends Controller
{
    public function getDummyData(Request $request)
    {
        // Data dummy sebagai contoh
        $dummyData = [
          [
            "id" => 1,
            "positionX" => "bottom-[42%]",
            "positionY" => "left-[-2.5%]",
            "nama" => "Camera 1"
          ],
          [
            "id" => 2,
            "positionX" => "bottom-[60%]",
            "positionY" => "left-[-0.5%]",
            "nama" => "Camera 2"
          ],
          [
            "id" => 3,
            "positionX" => "bottom-[59%]",
            "positionY" => "left-[43%]",
            "nama" => "Camera 3"
          ],
          [
            "id" => 4,
            "positionX" => "bottom-[37%]",
            "positionY" => "left-[53%]",
            "nama" => "Camera 4"
          ],
          [
            "id" => 5,
            "positionX" => "bottom-[60%]",
            "positionY" => "left-[94%]",
            "nama" => "Camera 4"
          ],
          [
            "id" => 6,
            "positionX" => "bottom-[41%]",
            "positionY" => "left-[92%]",
            "nama" => "Camera 4"
          ],
          [
            "id" => 7,
            "positionX" => "bottom-[14%]",
            "positionY" => "left-[73%]",
            "nama" => "Camera 4"
          ],
          [
            "id" => 8,
            "positionX" => "bottom-[6%]",
            "positionY" => "left-[56%]",
            "nama" => "Camera 4"
          ],
          [
            "id" => 9,
            "positionX" => "bottom-[14%]",
            "positionY" => "left-[29%]",
            "nama" => "Camera 4"
          ],
          [
            "id" => 10,
            "positionX" => "bottom-[6%]",
            "positionY" => "left-[13%]",
            "nama" => "Camera 4"
          ],
          [
            "id" => 11,
            "positionX" => "bottom-[92%]",
            "positionY" => "left-[29%]",
            "nama" => "Camera 4"
          ],
          [
            "id" => 12,
            "positionX" => "bottom-[84%]",
            "positionY" => "left-[11%]",
            "nama" => "Camera 4"
          ],
          [
            "id" => 13,
            "positionX" => "bottom-[92%]",
            "positionY" => "left-[73%]",
            "nama" => "Camera 4"
          ],
          [
            "id" => 14,
            "positionX" => "bottom-[84%]",
            "positionY" => "left-[56%]",
            "nama" => "Camera 4"
          ]
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


