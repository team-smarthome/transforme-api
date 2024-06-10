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
    $query = KameraLog::query();


    // Apply filters
    $filters = $request->input('filter', []);
    foreach ($filters as $field => $value) {
      if (!empty($value)) {
        $query->where($field, 'LIKE', "%$value%");
      }
    }

    // Get total records for pagination


    // Apply sorting and pagination
    $query->latest();
    // Execute the query and get the results
    $records = $query->get();

    // Format the records for response
    $formattedRecords = [];
    foreach ($records as $row) {
      $recordData = [
        'kamera_log_id' => $row->kamera_log_id,
        'image' => $row->image,
        'timestamp' => $row->timestamp,
        'kamera_id' => $row->kamera_id,
        'nama_kamera' => $row->nama_kamera,
        'lokasi_id' => $row->lokasi_otmil_id ?: $row->lokasi_lemasmil_id,
        'tipe_lokasi' => $row->lokasi_otmil_id ? 'otmil' : 'lemasmil',
        'nama_lokasi' => $row->nama_lokasi_otmil ?: $row->nama_lokasi_lemasmil,
      ];

      if ($row->wbp_profile_id) {
        $recordData['wbp_profile_id'] = $row->wbp_profile_id;
        $recordData['nama_wbp'] = $row->nama_wbp;
        $recordData['foto_wajah_wbp'] = $row->foto_wajah_wbp;
      }

      if ($row->petugas_id) {
        $recordData['petugas_id'] = $row->petugas_id;
        $recordData['nama_petugas'] = $row->nama_petugas;
        $recordData['foto_wajah_petugas'] = $row->foto_wajah_petugas;
      }

      if ($row->data_pengunjung_id) {
        $recordData['data_pengunjung_id'] = $row->data_pengunjung_id;
        $recordData['nama_pengunjung'] = $row->nama_pengunjung;
        $recordData['foto_wajah_pengunjung'] = $row->foto_wajah_pengunjung;
      }

      if ($row->wbp_profile_id === null && $row->petugas_id === null && $row->data_pengunjung_id === null) {
        $recordData['keterangan'] = 'Tidak Dikenal';
      } elseif ($row->wbp_profile_id !== null) {
        $recordData['keterangan'] = 'WBP';
      } elseif ($row->petugas_id !== null) {
        $recordData['keterangan'] = 'Petugas';
      } elseif ($row->data_pengunjung_id !== null) {
        $recordData['keterangan'] = 'Pengunjung';
      } else {
        $recordData['keterangan'] = 'Kesalahan Data';
      }

      $formattedRecords[] = $recordData;
    }

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
