<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\NasRequest;
use App\Http\Resources\NasResource;
use App\Models\NasModel;
use Exception;
use Illuminate\Http\Request;

class NasController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = NasModel::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);
      $filterableColumns = [
        'lokasi_otmil_id' => 'ruanganOtmil.lokasiOtmil.lokasi_otmil_id',
        'lokasi_lemasmil_id' => 'ruanganLemasmil.lokasiLemasmil.lokasi_lemasmil_id',
        'ruangan_otmil_id' => 'ruangan_otmil_id',
        'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
        'gmac' => 'gmac',
        'nama_nas' => 'nama_nas',
        'model' => 'model',
        'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
        'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan_lemasmil',
        'jenis_ruangan_otmil' => 'ruanganOtmil.jenis_ruangan_otmil',
        'jenis_ruangan_lemasmil' => 'ruanganLemasmil.jenis_ruangan_lemasmil',
        'status_nas' => 'status_nas'
      ];

      if ($request->has('nama_nas')) {
        $nama_nas = $request->input('nama_nas');
        if (is_array($nama_nas)) {
          $query->whereIn('nama_nas', $nama_nas);
        } else {
          $query->where('nama_nas', 'ilike', '%' . $nama_nas . '%');
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
      if ($request->has('status_nas')) {
        $status_nas = $request->input('status_nas');
        if (is_array($status_nas)) {
          $query->whereIn('status_nas', $status_nas);
        } else {
          $query->where('status_nas', 'ilike', '%' . $status_nas . '%');
        }
      }

      $query->latest();
      $nasData = $query->get();

      $totalNas = $nasData->count();
      $totalaktif = $nasData->where('status_nas', 'aktif')->count();
      $totalnonaktif = $nasData->where('status_nas', 'nonaktif')->count();

      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = NasResource::collection($paginatedData);

      $responseData = [
        "status" => "OK",
        "message" => "Successfully get Data",
        "records" => $resourceCollection->toArray($request),
        "totalNas" => $totalNas,
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

  public function store(NasRequest $request)
  {
    try {
      if (NasModel::where('gmac', $request->gmac)->exists()) {
        return ApiResponse::error('Failed to create Nas.', 'Gmac already exists.');
      }

      $Nas = new NasModel([
        'gmac' => $request->gmac,
        'nama_nas' => $request->nama_nas,
        'ruangan_otmil_id' => $request->ruangan_otmil_id,
        'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
        'status_nas' => $request->status_nas,
        'v_nas_topic' => $request->v_nas_topic
      ]);

      $Nas->save();

      return ApiResponse::created($Nas);
    } catch (Exception $e) {
      return ApiResponse::error('Failed to create Nas.', $e->getMessage());
    }
  }

  public function update(NasRequest $request)
  {
    try {
      $id = $request->input('nas_id');
      $Nas = NasModel::findOrFail($id);
      $Nas->gmac = $request->gmac;
      $Nas->nama_nas = $request->nama_nas;
      $Nas->ruangan_otmil_id = $request->ruangan_otmil_id;
      $Nas->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
      $Nas->status_nas = $request->status_nas;
      $Nas->v_nas_topic = $request->v_nas_topic;

      $Nas->save();

      return ApiResponse::updated($Nas);
    } catch (Exception $e) {
      return ApiResponse::error('Failed to update Face Rec.', $e->getMessage());
    }
  }

  public function destroy(Request $request)
  {
    try {
      $id = $request->input('nas_id');
      $FaceRec = NasModel::findOrFail($id);
      if (!$FaceRec) {
        return ApiResponse::error('Nas not found.', 'Nas not found.', 404);
      }
      $FaceRec->delete();
      return ApiResponse::deleted();
    } catch (Exception $e) {
      return ApiResponse::error('Failed to delete Nas.', $e->getMessage());
    }
  }
}
