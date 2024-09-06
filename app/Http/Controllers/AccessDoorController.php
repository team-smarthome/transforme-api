<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\AccessDoor;
use Illuminate\Http\Request;
use App\Http\Resources\AccessDoorResource;

class AccessDoorController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = AccessDoor::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);
      $filterableColumns = [
        'lokasi_otmil_id' => 'ruanganOtmil.lokasiOtmil.lokasi_otmil_id',
        'lokasi_lemasmil_id' => 'ruanganLemasmil.lokasiLemasmil.lokasi_lemasmil_id',
        'ruangan_otmil_id' => 'ruangan_otmil_id',
        'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
        'gmac' => 'gmac',
        'nama_access_door' => 'nama_access_door',
        'model' => 'model',
        'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
        'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan_lemasmil',
        'jenis_ruangan_otmil' => 'ruanganOtmil.jenis_ruangan_otmil',
        'jenis_ruangan_lemasmil' => 'ruanganLemasmil.jenis_ruangan_lemasmil',
        'status_access_door' => 'status_access_door'
      ];

      if ($request->has('nama_access_door')) {
        $nama_access_door = $request->input('nama_access_door');
        if (is_array($nama_access_door)) {
          $query->whereIn('nama_access_door', $nama_access_door);
        } else {
          $query->where('nama_access_door', 'ilike', '%' . $nama_access_door . '%');
        }
      }

      if ($request->has('status_access_door')) {
        $status_access_door = $request->input('status_access_door');
        if (is_array($status_access_door)) {
          $query->whereIn('status_access_door', $status_access_door);
        } else {
          $query->where('status_access_door', 'ilike', '%' . $status_access_door . '%');
        }
      }

      if ($request->has('gedung_otmil_id')) {
        $gedung_otmil_id = $request->input('gedung_otmil_id');
        if (is_array($gedung_otmil_id)) {
          $query->whereHas('ruanganOtmil.lantaiOtmil', function ($q) use ($gedung_otmil_id) {
            $q->whereIn('gedung_otmil_id', $gedung_otmil_id);
          });
        } else {
          $query->whereHas('ruanganOtmil.lantaiOtmil', function ($q) use ($gedung_otmil_id) {
            $q->where('gedung_otmil_id', $gedung_otmil_id);
          });
        }
      }

      if ($request->has('lantai_otmil_id')) {
        $lantai_otmil_id = $request->input('lantai_otmil_id');
        if (is_array($lantai_otmil_id)) {
          $query->whereHas('ruanganOtmil', function ($q) use ($lantai_otmil_id) {
            $q->whereIn('lantai_otmil_id', $lantai_otmil_id);
          });
        } else {
          $query->whereHas('ruanganOtmil', function ($q) use ($lantai_otmil_id) {
            $q->where('lantai_otmil_id', $lantai_otmil_id);
          });
        }
      }

      if ($request->has('ruangan_otmil_id')) {
        $ruangan_otmil_id = $request->input('ruangan_otmil_id');
        if (is_array($ruangan_otmil_id)) {
          $query->whereIn('ruangan_otmil_id', $ruangan_otmil_id);
        } else {
          $query->where('ruangan_otmil_id', $ruangan_otmil_id);
        }
      }
      if ($request->has('status_access_door')) {
        $status_access_door = $request->input('status_access_door');
        if (is_array($status_access_door)) {
          $query->whereIn('status_access_door', $status_access_door);
        } else {
          $query->where('status_access_door', 'ilike', '%' . $status_access_door . '%');
        }
      }
      $query->latest();
      $accessPointData = $query->get();

      $totalAccessDoor = $accessPointData->count();
      $totalaktif = $accessPointData->where('status_access_door', 'aktif')->count();
      $totalnonaktif = $accessPointData->where('status_access_door', 'nonaktif')->count();

      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = AccessDoorResource::collection($paginatedData);

      $responseData = [
        "status" => "OK",
        "message" => "Successfully get Data",
        "records" => $resourceCollection->toArray($request),
        "totalAccessDoor" => $totalAccessDoor,
        "totalaktif" => $totalaktif,
        "totalnonaktif" => $totalnonaktif,
        "pagination" => [
          "currentPage" => $paginatedData->currentPage(),
          "pageSize" => $paginatedData->perPage(),
          "from" => $paginatedData->firstItem(),
          "to" => $paginatedData->lastItem(),
          "totalRecords" => $paginatedData->total(),
          "totalPages" => $paginatedData->lastPage()
        ]
      ];

      return response()->json($responseData);
    } catch (\Exception $e) {
      return ApiResponse::error('Failed to get Data.', $e->getMessage());
    }
  }

  // public function getDummyData(Request $request)
  // {
  //     // Data dummy sebagai contoh
  //     $dummyData = [
  //         [
  //             "id" => 1,
  //             "positionX" =>  "bottom-[48%]",
  //             "positionY" =>  "left-[-3%]",
  //             "nama" => "Access Door 1"
  //         ],
  //         [
  //             "id" => 2,
  //             "positionX" =>"bottom-[48%]",
  //             "positionY" =>"left-[-13%]",
  //             "nama" => "Access Door 2"
  //         ],
  //         [
  //             "id" => 3,
  //             "positionX" =>"bottom-[84%]",
  //             "positionY" =>"left-[19%]",
  //             "nama" => "Access Door 3"
  //         ],
  //         [
  //             "id" => 4,
  //             "positionX" => "bottom-[14%]",
  //             "positionY" => "left-[19%]",
  //             "nama" => "Access Door 4"
  //         ],
  //         [
  //             "id" => 5,
  //             "positionX" => "bottom-[38%]",
  //             "positionY" => "left-[47%]",
  //             "nama" => "Access Door 5"
  //         ],
  //         [
  //             "id" => 6,
  //             "positionX" => "bottom-[58%]",
  //             "positionY" =>"left-[47%]",
  //             "nama" => "Access Door 6"
  //         ],
  //          [
  //             "id" => 7,
  //             "positionX" => "bottom-[48%]",
  //             "positionY" => "left-[91%]",
  //             "nama" => "Access Door 7"
  //         ],
  //         [
  //             "id" => 8,
  //             "positionX" =>  "bottom-[68%]",
  //             "positionY" => "left-[81%]",
  //             "nama" => "Access Door 8"
  //         ],
  //         [
  //             "id" => 9,
  //             "positionX" =>"bottom-[14%]",
  //             "positionY" => "left-[64%]",
  //             "nama" => "Access Door 9"
  //         ],
  //         [
  //             "id" => 10,
  //             "positionX" => "bottom-[84%]",
  //             "positionY" => "left-[64%]",
  //             "nama" => "Access Door 10"
  //         ],

  //     ];


  //     // Filter berdasarkan nama jika parameter nama tersedia
  //     if ($request->has('nama')) {
  //         $namaFilter = $request->input('nama');

  //         // Pastikan $namaFilter adalah array, bahkan jika hanya satu nilai yang diberikan
  //         if (!is_array($namaFilter)) {
  //             $namaFilter = [$namaFilter];
  //         }

  //         $dummyData = array_filter($dummyData, function ($item) use ($namaFilter) {
  //             return in_array($item['nama'], $namaFilter);
  //         });
  //     }

  //     $response = [
  //         "status" => "OK",
  //         "message" => "Successfully get Data",
  //         "records" => array_values($dummyData) // Reindex array setelah filter
  //     ];

  //     return response()->json($response);
  // }
}
