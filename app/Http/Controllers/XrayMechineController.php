<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\XrayMechineRequest;
use App\Http\Resources\XrayMechineResource;
use App\Models\XrayMechineModel;
use Exception;
use Illuminate\Http\Request;

class XrayMechineController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = XrayMechineModel::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);

      if ($request->has('nama_xray_mechine')) {
        $nama_xray_mechine = $request->input('nama_xray_mechine');
        if (is_array($nama_xray_mechine)) {
          $query->whereIn('nama_xray_mechine', $nama_xray_mechine);
        } else {
          $query->where('nama_xray_mechine', 'ilike', '%' . $nama_xray_mechine . '%');
        }
      }


      if ($request->has('status_xray_mechine')) {
        $status_xray_mechine = $request->input('status_xray_mechine');
        if (is_array($status_xray_mechine)) {
          $query->whereIn('status_xray_mechine', $status_xray_mechine);
        } else {
          $query->where('status_xray_mechine', 'ilike', '%' . $status_xray_mechine . '%');
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
      $query->latest();
      $xray_mechineData = $query->get();

      $totalxray_mechine = $xray_mechineData->count();
      $totalaktif = $xray_mechineData->where('status_xray_mechine', 'aktif')->count();
      $totalnonaktif = $xray_mechineData->where('status_xray_mechine', 'nonaktif')->count();

      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = XrayMechineResource::collection($paginatedData);

      $responseData = [
        "status" => "OK",
        "message" => "Successfully get Data",
        "records" => $resourceCollection->toArray($request),
        "totalxray_mechine$totalxray_mechine" => $totalxray_mechine,
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

  public function store(XrayMechineRequest $request)
  {
    try {
      if (XrayMechineModel::where('gmac', $request->gmac)->exists()) {
        return ApiResponse::error('Failed to create xray_mechine.', 'Gmac already exists.');
      }

      $xray_mechine = new XrayMechineModel([
        'gmac' => $request->gmac,
        'nama_xray_mechine' => $request->nama_xray_mechine,
        'ruangan_otmil_id' => $request->ruangan_otmil_id,
        'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
        'status_xray_mechine' => $request->status_xray_mechine,
        'v_xray_mechine_topic' => $request->v_xray_mechine_topic,
        'posisi_X' => $request->posisi_X,
        'posisi_Y' => $request->posisi_Y
      ]);

      $xray_mechine->save();

      return ApiResponse::created($xray_mechine);
    } catch (Exception $e) {
      return ApiResponse::error('Failed to create xray_mechine.', $e->getMessage());
    }
  }

  public function update(XrayMechineRequest $request)
  {
    try {
      $id = $request->input('xray_mechine_id');
      $xray_mechine = XrayMechineModel::findOrFail($id);
      $xray_mechine->gmac = $request->gmac;
      $xray_mechine->nama_xray_mechine = $request->nama_xray_mechine;
      $xray_mechine->ruangan_otmil_id = $request->ruangan_otmil_id;
      $xray_mechine->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
      $xray_mechine->status_xray_mechine = $request->status_xray_mechine;
      $xray_mechine->v_xray_mechine_topic = $request->v_xray_mechine_topic;

      $xray_mechine->save();

      return ApiResponse::updated($xray_mechine);
    } catch (Exception $e) {
      return ApiResponse::error('Failed to update Face Rec.', $e->getMessage());
    }
  }

  public function destroy(Request $request)
  {
    try {
      $id = $request->input('xray_mechine_id');
      $FaceRec = XrayMechineModel::findOrFail($id);
      if (!$FaceRec) {
        return ApiResponse::error('xray_mechine not found.', 'xray_mechine not found.', 404);
      }
      $FaceRec->delete();
      return ApiResponse::deleted();
    } catch (Exception $e) {
      return ApiResponse::error('Failed to delete xray_mechine.', $e->getMessage());
    }
  }
}
