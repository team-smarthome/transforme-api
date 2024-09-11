<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AutogateDualRequest;
use App\Http\Resources\AutogateDualResource;
use App\Models\AutogateDualModel;
use Exception;
use Illuminate\Http\Request;

class AutogateDualController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = AutogateDualModel::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);

      if ($request->has('nama_autogate_dual')) {
        $nama_autogate_dual = $request->input('nama_autogate_dual');
        if (is_array($nama_autogate_dual)) {
          $query->whereIn('nama_autogate_dual', $nama_autogate_dual);
        } else {
          $query->where('nama_autogate_dual', 'ilike', '%' . $nama_autogate_dual . '%');
        }
      }


      if ($request->has('status_autogate_dual')) {
        $status_autogate_dual = $request->input('status_autogate_dual');
        if (is_array($status_autogate_dual)) {
          $query->whereIn('status_autogate_dual', $status_autogate_dual);
        } else {
          $query->where('status_autogate_dual', 'ilike', '%' . $status_autogate_dual . '%');
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
      $autogate_dualData = $query->get();

      $totalautogate_dual = $autogate_dualData->count();
      $totalaktif = $autogate_dualData->where('status_autogate_dual', 'aktif')->count();
      $totalnonaktif = $autogate_dualData->where('status_autogate_dual', 'nonaktif')->count();

      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = AutogateDualResource::collection($paginatedData);

      $responseData = [
        "status" => "OK",
        "message" => "Successfully get Data",
        "records" => $resourceCollection->toArray($request),
        "totalautogate_dual$totalautogate_dual" => $totalautogate_dual,
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

  public function store(AutogateDualRequest $request)
  {
    try {
      if (AutogateDualModel::where('gmac', $request->gmac)->exists()) {
        return ApiResponse::error('Failed to create autogate_dual.', 'Gmac already exists.');
      }

      $autogate_dual = new AutogateDualModel([
        'gmac' => $request->gmac,
        'nama_autogate_dual' => $request->nama_autogate_dual,
        'ruangan_otmil_id' => $request->ruangan_otmil_id,
        'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
        'status_autogate_dual' => $request->status_autogate_dual,
        'v_autogate_dual_topic' => $request->v_autogate_dual_topic
      ]);

      $autogate_dual->save();

      return ApiResponse::created($autogate_dual);
    } catch (Exception $e) {
      return ApiResponse::error('Failed to create autogate_dual.', $e->getMessage());
    }
  }

  public function update(AutogateDualRequest $request)
  {
    try {
      $id = $request->input('autogate_dual_id');
      $autogate_dual = AutogateDualModel::findOrFail($id);
      $autogate_dual->gmac = $request->gmac;
      $autogate_dual->nama_autogate_dual = $request->nama_autogate_dual;
      $autogate_dual->ruangan_otmil_id = $request->ruangan_otmil_id;
      $autogate_dual->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
      $autogate_dual->status_autogate_dual = $request->status_autogate_dual;
      $autogate_dual->v_autogate_dual_topic = $request->v_autogate_dual_topic;

      $autogate_dual->save();

      return ApiResponse::updated($autogate_dual);
    } catch (Exception $e) {
      return ApiResponse::error('Failed to update Face Rec.', $e->getMessage());
    }
  }

  public function destroy(Request $request)
  {
    try {
      $id = $request->input('autogate_dual_id');
      $FaceRec = AutogateDualModel::findOrFail($id);
      if (!$FaceRec) {
        return ApiResponse::error('autogate_dual not found.', 'autogate_dual not found.', 404);
      }
      $FaceRec->delete();
      return ApiResponse::deleted();
    } catch (Exception $e) {
      return ApiResponse::error('Failed to delete autogate_dual.', $e->getMessage());
    }
  }
}
