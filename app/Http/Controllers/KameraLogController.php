<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\KameraLogResource;
use App\Models\KameraLog;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KameraLogController extends Controller
{

  public function index(Request $request)
  {
    // Set default values for pagination


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


    // Apply filters
    $filters = $request->input('filter', []);
    foreach ($filters as $field => $value) {
      if (!empty($value)) {
        switch ($field) {
          case 'nama_kamera':
            $query->whereHas('kamera', function ($query) use ($value) {
              $query->where('nama_kamera', 'LIKE', "%$value%");
            });
            break;
          case 'tipe_lokasi':
            $query->where(function ($query) use ($value) {
              $query->whereHas('kamera.ruanganOtmil', function ($query) use ($value) {
                $query->where('tipe_lokasi', $value);
              })->orWhereHas('kamera.ruanganLemasmil', function ($query) use ($value) {
                $query->where('tipe_lokasi', $value);
              });
            });
            break;
          case 'nama_lokasi':
            $query->where(function ($query) use ($value) {
              $query->whereHas('kamera.ruanganOtmil.lokasiOtmil', function ($query) use ($value) {
                $query->where('nama_lokasi_otmil', 'LIKE', "%$value%");
              })->orWhereHas('kamera.ruanganLemasmil.lokasiLemasMil', function ($query) use ($value) {
                $query->where('nama_lokasi_lemasmil', 'LIKE', "%$value%");
              });
            });
            break;
          default:
            $query->where($field, 'LIKE', "%$value%");
            break;
        }
      }
    }

    // Get total records for pagination


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
}
