<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PalmVeinRequest;
use App\Http\Resources\PalmVeinResource;
use App\Models\PalmVeinModel;
use Exception;
use Illuminate\Http\Request;

class PalmVeinController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = PalmVeinModel::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);

      if ($request->has('nama_palm_vein_access_control')) {
        $nama_palm_vein_access_control = $request->input('nama_palm_vein_access_control');
        if (is_array($nama_palm_vein_access_control)) {
          $query->whereIn('nama_palm_vein_access_control', $nama_palm_vein_access_control);
        } else {
          $query->where('nama_palm_vein_access_control', 'ilike', '%' . $nama_palm_vein_access_control . '%');
        }
      }


      if ($request->has('status_palm_vein_access_control')) {
        $status_palm_vein_access_control = $request->input('status_palm_vein_access_control');
        if (is_array($status_palm_vein_access_control)) {
          $query->whereIn('status_palm_vein_access_control', $status_palm_vein_access_control);
        } else {
          $query->where('status_palm_vein_access_control', 'ilike', '%' . $status_palm_vein_access_control . '%');
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
      $palm_vein_access_controlData = $query->get();

      $totalpalm_vein_access_control = $palm_vein_access_controlData->count();
      $totalaktif = $palm_vein_access_controlData->where('status_palm_vein_access_control', 'aktif')->count();
      $totalnonaktif = $palm_vein_access_controlData->where('status_palm_vein_access_control', 'nonaktif')->count();

      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = PalmVeinResource::collection($paginatedData);

      $responseData = [
        "status" => "OK",
        "message" => "Successfully get Data",
        "records" => $resourceCollection->toArray($request),
        "totalpalm_vein_access_control$totalpalm_vein_access_control" => $totalpalm_vein_access_control,
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

  public function store(PalmVeinRequest $request)
  {
    try {
      if (PalmVeinModel::where('gmac', $request->gmac)->exists()) {
        return ApiResponse::error('Failed to create palm_vein_access_control.', 'Gmac already exists.');
      }

      $palm_vein_access_control = new PalmVeinModel([
        'gmac' => $request->gmac,
        'nama_palm_vein_access_control' => $request->nama_palm_vein_access_control,
        'ruangan_otmil_id' => $request->ruangan_otmil_id,
        'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
        'status_palm_vein_access_control' => $request->status_palm_vein_access_control,
        'v_palm_vein_access_control_topic' => $request->v_palm_vein_access_control_topic
      ]);

      $palm_vein_access_control->save();

      return ApiResponse::created($palm_vein_access_control);
    } catch (Exception $e) {
      return ApiResponse::error('Failed to create palm_vein_access_control.', $e->getMessage());
    }
  }

  public function update(PalmVeinRequest $request)
  {
    try {
      $id = $request->input('palm_vein_access_control_id');
      $palm_vein_access_control = PalmVeinModel::findOrFail($id);
      $palm_vein_access_control->gmac = $request->gmac;
      $palm_vein_access_control->nama_palm_vein_access_control = $request->nama_palm_vein_access_control;
      $palm_vein_access_control->ruangan_otmil_id = $request->ruangan_otmil_id;
      $palm_vein_access_control->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
      $palm_vein_access_control->status_palm_vein_access_control = $request->status_palm_vein_access_control;
      $palm_vein_access_control->v_palm_vein_access_control_topic = $request->v_palm_vein_access_control_topic;

      $palm_vein_access_control->save();

      return ApiResponse::updated($palm_vein_access_control);
    } catch (Exception $e) {
      return ApiResponse::error('Failed to update Face Rec.', $e->getMessage());
    }
  }

  public function destroy(Request $request)
  {
    try {
      $id = $request->input('palm_vein_access_control_id');
      $FaceRec = PalmVeinModel::findOrFail($id);
      if (!$FaceRec) {
        return ApiResponse::error('palm_vein_access_control not found.', 'palm_vein_access_control not found.', 404);
      }
      $FaceRec->delete();
      return ApiResponse::deleted();
    } catch (Exception $e) {
      return ApiResponse::error('Failed to delete palm_vein_access_control.', $e->getMessage());
    }
  }
}
