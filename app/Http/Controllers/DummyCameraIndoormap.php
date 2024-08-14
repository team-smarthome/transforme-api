<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DummyCameraIndoormap extends Controller
{
    public function getDummyData(Request $request)
    {
        // Data dummy sebagai contoh
        $dummyData = [
            ["id" => 1, "positionX" => "bottom-[42%]", "positionY" => "left-[-2.5%]", "nama" => "Joyvision 1", "is_play" => false, "IpAddress" => "192.168.1.2", "urlRTSP" => "rtsp://admin:admindev123@192.168.1.2:8554"],
            ["id" => 2, "positionX" => "bottom-[60%]", "positionY" => "left-[-0.5%]", "nama" => "Joyvision 2", "is_play" => true, "IpAddress" => "192.168.1.2", "urlRTSP" => "rtsp://admin:admindev123@192.168.1.2:8554"],
            ["id" => 3, "positionX" => "bottom-[59%]", "positionY" => "left-[43%]", "nama" => "Joyvision 3", "is_play" => false, "IpAddress" => "192.168.1.2", "urlRTSP" => "rtsp://admin:admindev123@192.168.1.2:8554"],
            ["id" => 4, "positionX" => "bottom-[37%]", "positionY" => "left-[53%]", "nama" => "Joyvision 4", "is_play" => true, "IpAddress" => "192.168.1.2", "urlRTSP" => "rtsp://admin:admindev123@192.168.1.2:8554"],
            ["id" => 5, "positionX" => "bottom-[60%]", "positionY" => "left-[94%]", "nama" => "Joyvision 5", "is_play" => false, "IpAddress" => "192.168.1.2", "urlRTSP" => "rtsp://admin:admindev123@192.168.1.2:8554"],
            ["id" => 6, "positionX" => "bottom-[41%]", "positionY" => "left-[92%]", "nama" => "Joyvision 6", "is_play" => false, "IpAddress" => "192.168.1.2", "urlRTSP" => "rtsp://admin:admindev123@192.168.1.2:8554"],
            ["id" => 7, "positionX" => "bottom-[14%]", "positionY" => "left-[73%]", "nama" => "Joyvision 7", "is_play" => false, "IpAddress" => "192.168.1.2", "urlRTSP" => "rtsp://admin:admindev123@192.168.1.2:8554"],
            ["id" => 8, "positionX" => "bottom-[6%]", "positionY" => "left-[56%]", "nama" => "Joyvision 8", "is_play" => false, "IpAddress" => "192.168.1.2", "urlRTSP" => "rtsp://admin:admindev123@192.168.1.2:8554"],
            ["id" => 9, "positionX" => "bottom-[14%]", "positionY" => "left-[29%]", "nama" => "Joyvision 9", "is_play" => false, "IpAddress" => "192.168.1.2", "urlRTSP" => "rtsp://admin:admindev123@192.168.1.2:8554"],
            ["id" => 10, "positionX" => "bottom-[6%]", "positionY" => "left-[13%]", "nama" => "Joyvision 10", "is_play" => false, "IpAddress" => "192.168.1.2", "urlRTSP" => "rtsp://admin:admindev123@192.168.1.2:8554"],
            ["id" => 11, "positionX" => "bottom-[92%]", "positionY" => "left-[29%]", "nama" => "Joyvision 11", "is_play" => false, "IpAddress" => "192.168.1.2", "urlRTSP" => "rtsp://admin:admindev123@192.168.1.2:8554"],
            ["id" => 12, "positionX" => "bottom-[84%]", "positionY" => "left-[11%]", "nama" => "Joyvision 12", "is_play" => false, "IpAddress" => "192.168.1.2", "urlRTSP" => "rtsp://admin:admindev123@192.168.1.2:8554"],
            ["id" => 13, "positionX" => "bottom-[92%]", "positionY" => "left-[73%]", "nama" => "Joyvision 13", "is_play" => false, "IpAddress" => "192.168.1.2", "urlRTSP" => "rtsp://admin:admindev123@192.168.1.2:8554"],
            ["id" => 14, "positionX" => "bottom-[84%]", "positionY" => "left-[56%]", "nama" => "Joyvision 14", "is_play" => false, "IpAddress" => "192.168.1.2", "urlRTSP" => "rtsp://admin:admindev123@192.168.1.2:8554"]
        ];

        // Filter berdasarkan is_play jika parameter is_play tersedia
        if ($request->has('is_play')) {
            $isPlayFilter = filter_var($request->input('is_play'), FILTER_VALIDATE_BOOLEAN);

            $dummyData = array_filter($dummyData, function ($item) use ($isPlayFilter) {
                return $item['is_play'] === $isPlayFilter;
            });
        }

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
