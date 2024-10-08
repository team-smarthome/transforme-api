<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\KameraLog;
use App\Models\LokasiOtmil;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Resources\KameraLogResource;
use App\Http\Resources\LokasiOtmilResource;


class KameraLogController extends Controller
{

  public function index(Request $request)
  {
    // Set default values for pagination
    $kameraId = $request->input('kameraId');
    $lokasiId = $request->input('lokasiId');

    // Set default values for sorting
    $sortField = $request->input('sortBy', 'timestamp');
    // $sortOrder = $request->input('sortOrder', 'DESC');

    // Allowed sort fields
    $allowedSortFields = ['nama_kamera', 'nama_wbp', 'timestamp'];
    if (!in_array($sortField, $allowedSortFields)) {
      $sortField = 'timestamp'; // Default to 'timestamp' if the provided field is not allowed
    }
    $query = KameraLog::with([
      'kamera.ruanganOtmil.lokasiOtmil',
      'kamera.ruanganLemasMil.lokasiLemasMil',
      'wbp_profile',
      'petugas',
      'pengunjung'
    ]);
    if(isset($kameraId))
    {
    $query->whereHas('kamera', function ($q) use ($kameraId){
      $q->where('id', $kameraId);
    });
    };
    if(isset($lokasiId))
    {
    $query->whereHas('kamera.ruanganOtmil.lokasiOtmil', function ($q) use ($lokasiId){
      $q->where('id', $lokasiId);
    });
    };

    // Apply filters
    // $filters = $request->input('filter', []);
    // foreach ($filters as $field => $value) {
    //   if (!empty($value)) {
    //     switch ($field) {
    //       case 'nama_kamera':
    //         $query->whereHas('kamera', function ($query) use ($value) {
    //           $query->where('nama_kamera', 'LIKE', "%$value%");
    //         });
    //         break;
    //       case 'tipe_lokasi':
    //         $query->where(function ($query) use ($value) {
    //           $query->whereHas('kamera.ruanganOtmil', function ($query) use ($value) {
    //             $query->where('tipe_lokasi', $value);
    //           })->orWhereHas('kamera.ruanganLemasmil', function ($query) use ($value) {
    //             $query->where('tipe_lokasi', $value);
    //           });
    //         });
    //         break;
    //       case 'nama_lokasi':
    //         $query->where(function ($query) use ($value) {
    //           $query->whereHas('kamera.ruanganOtmil.lokasiOtmil', function ($query) use ($value) {
    //             $query->where('nama_lokasi_otmil', 'LIKE', "%$value%");
    //           })->orWhereHas('kamera.ruanganLemasmil.lokasiLemasMil', function ($query) use ($value) {
    //             $query->where('nama_lokasi_lemasmil', 'LIKE', "%$value%");
    //           });
    //         });
    //         break;
    //       default:
    //         $query->where($field, 'LIKE', "%$value%");
    //         break;
    //     }
    //   }
    // }

    // Get total records for pagination

    $query->limit(100);
    // Apply sorting and pagination
    $query->latest();
    // Execute the query and get the results


    // Prepare the JSON response with pagination information
    $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
    $resourceCollection = KameraLogResource::collection($paginatedData);
    return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
  }
  public function store(Request $request)
  {
    try {
      $validatedData = $request->validate([
        'wbp_profile_id' => 'required|uuid|exists:wbp_profile,id',
        'image' => 'nullable|image|max:2048', // Max size 2MB
        'kamera_id' => 'required|uuid|exists:kamera,id',
        // 'foto_wajah_fr' => 'nullable|image|max:2048', // Max size 2MB
      ]);

      if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('kamera_log', 'public');
        $validatedData['image'] = 'storage/' . str_replace('public/', '', $imagePath);
      }
      print_r($validatedData);
      $kamera_log = KameraLog::create($validatedData);

      return ApiResponse::created($kamera_log);
    } catch (QueryException $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
      return ApiResponse::error('Failed to get Data.', $e->getMessage());
    }
  }

  public function getAllLokasi(Request $request)
  {
      try {
          $lokasiRecords = LokasiOtmil::with('ruanganOtmil.kamera')->get(); 

          $dataWithRelations = [];
          foreach ($lokasiRecords as $lokasi) {
              $kameraList = [];
              foreach ($lokasi->ruanganOtmil as $ruangan) {
                  foreach ($ruangan->kamera as $kamera) {
                      $kameraList[] = $kamera;
                  }
              }

              $dataWithRelations[] = [
                  'lokasi_otmil_id' => $lokasi->id,
                  'nama_lokasi_otmil' => $lokasi->nama_lokasi_otmil,
                  'latitude' => $lokasi->latitude,
                  'longitude' => $lokasi->longitude,
                  'kamera' => $kameraList,
                  'lokasi_otmil_id' => $lokasi->id,
              ];
          }

          return ApiResponse::success($dataWithRelations, 'Successfully got data');
      } catch (\Exception $e) {
          return ApiResponse::error('Failed to get data.', $e->getMessage());
      }
  }
}
