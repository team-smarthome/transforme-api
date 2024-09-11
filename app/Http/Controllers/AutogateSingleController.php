<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AutogateSingleRequest;
use App\Http\Resources\AutogateSingleResource;
use App\Models\AutogateSingleModel;
use Exception;
use Illuminate\Http\Request;

class AutogateSingleController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = AutogateSingleModel::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);

      if ($request->has('nama_autogate_single')) {
        $nama_autogate_single = $request->input('nama_autogate_single');
        if (is_array($nama_autogate_single)) {
          $query->whereIn('nama_autogate_single', $nama_autogate_single);
        } else {
          $query->where('nama_autogate_single', 'ilike', '%' . $nama_autogate_single . '%');
        }
      }


      if ($request->has('status_autogate_single')) {
        $status_autogate_single = $request->input('status_autogate_single');
        if (is_array($status_autogate_single)) {
          $query->whereIn('status_autogate_single', $status_autogate_single);
        } else {
          $query->where('status_autogate_single', 'ilike', '%' . $status_autogate_single . '%');
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
      $autogate_singleData = $query->get();

      $totalautogate_single = $autogate_singleData->count();
      $totalaktif = $autogate_singleData->where('status_autogate_single', 'aktif')->count();
      $totalnonaktif = $autogate_singleData->where('status_autogate_single', 'nonaktif')->count();

      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = AutogateSingleResource::collection($paginatedData);

      $responseData = [
        "status" => "OK",
        "message" => "Successfully get Data",
        "records" => $resourceCollection->toArray($request),
        "totalautogate_single$totalautogate_single" => $totalautogate_single,
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

  public function store(AutogateSingleRequest $request)
  {
    try {
      if (AutogateSingleModel::where('gmac', $request->gmac)->exists()) {
        return ApiResponse::error('Failed to create autogate_single.', 'Gmac already exists.');
      }

      $autogate_single = new AutogateSingleModel([
        'gmac' => $request->gmac,
        'nama_autogate_single' => $request->nama_autogate_single,
        'ruangan_otmil_id' => $request->ruangan_otmil_id,
        'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
        'status_autogate_single' => $request->status_autogate_single,
        'v_autogate_single_topic' => $request->v_autogate_single_topic
      ]);

      $autogate_single->save();

      return ApiResponse::created($autogate_single);
    } catch (Exception $e) {
      return ApiResponse::error('Failed to create autogate_single.', $e->getMessage());
    }
  }

  public function update(AutogateSingleRequest $request)
  {
    try {
      $id = $request->input('autogate_single_id');
      $autogate_single = AutogateSingleModel::findOrFail($id);
      $autogate_single->gmac = $request->gmac;
      $autogate_single->nama_autogate_single = $request->nama_autogate_single;
      $autogate_single->ruangan_otmil_id = $request->ruangan_otmil_id;
      $autogate_single->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
      $autogate_single->status_autogate_single = $request->status_autogate_single;
      $autogate_single->v_autogate_single_topic = $request->v_autogate_single_topic;

      $autogate_single->save();

      return ApiResponse::updated($autogate_single);
    } catch (Exception $e) {
      return ApiResponse::error('Failed to update Face Rec.', $e->getMessage());
    }
  }

  public function destroy(Request $request)
  {
    try {
      $id = $request->input('autogate_single_id');
      $FaceRec = AutogateSingleModel::findOrFail($id);
      if (!$FaceRec) {
        return ApiResponse::error('autogate_single not found.', 'autogate_single not found.', 404);
      }
      $FaceRec->delete();
      return ApiResponse::deleted();
    } catch (Exception $e) {
      return ApiResponse::error('Failed to delete autogate_single.', $e->getMessage());
    }
  }
}
