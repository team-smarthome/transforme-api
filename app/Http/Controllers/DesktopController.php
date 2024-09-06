<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\DesktopResource;
use App\Models\Desktop;
use Illuminate\Http\Request;


class DesktopController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = Desktop::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);
      $filterableColumns = [
        'lokasi_otmil_id' => 'ruanganOtmil.lokasiOtmil.lokasi_otmil_id',
        'lokasi_lemasmil_id' => 'ruanganLemasmil.lokasiLemasmil.lokasi_lemasmil_id',
        'ruangan_otmil_id' => 'ruangan_otmil_id',
        'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
        'gmac' => 'gmac',
        'nama_desktop' => 'nama_desktop',
        'model' => 'model',
        'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
        'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan_lemasmil',
        'jenis_ruangan_otmil' => 'ruanganOtmil.jenis_ruangan_otmil',
        'jenis_ruangan_lemasmil' => 'ruanganLemasmil.jenis_ruangan_lemasmil',
        'status_desktop' => 'status_desktop'
      ];


      if ($request->has('nama_desktop')) {
        $nama_desktop = $request->input('nama_desktop');
        if (is_array($nama_desktop)) {
          $query->whereIn('nama_desktop', $nama_desktop);
        } else {
          $query->where('nama_desktop', 'ilike', '%' . $nama_desktop . '%');
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
      if ($request->has('status_desktop')) {
        $status_desktop = $request->input('status_desktop');
        if (is_array($status_desktop)) {
          $query->whereIn('status_desktop', $status_desktop);
        } else {
          $query->where('status_desktop', 'ilike', '%' . $status_desktop . '%');
        }
      }


      $query->latest();
      $accessPointData = $query->get();

      $totalDesktop = $accessPointData->count();
      $totalaktif = $accessPointData->where('status_desktop', 'aktif')->count();
      $totalnonaktif = $accessPointData->where('status_desktop', 'nonaktif')->count();

      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = DesktopResource::collection($paginatedData);

      $responseData = [
        "status" => "OK",
        "message" => "Successfully get Data",
        "records" => $resourceCollection->toArray($request),
        "totalDesktop" => $totalDesktop,
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
  //             "positionX" => "bottom-[66%]",
  //             "positionY" => "left-[-10.5%]",
  //             "nama" => "Interactive Desktop 1"
  //         ],    
  //         [
  //             "id" => 2,
  //             "positionX" => "bottom-[70%]",
  //             "positionY" => "left-[-12.5%]",
  //             "nama" => "Interactive Desktop 2"
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
