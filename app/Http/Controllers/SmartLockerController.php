<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\SmartlockerRequest;
use App\Http\Resources\SmartLockerResource;
use App\Models\SmartLockerModel;
use Exception;
use Illuminate\Http\Request;

class SmartLockerController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = SmartLockerModel::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);

      if ($request->has('nama_smartlocker')) {
        $nama_smartlocker = $request->input('nama_smartlocker');
        if (is_array($nama_smartlocker)) {
          $query->whereIn('nama_smartlocker', $nama_smartlocker);
        } else {
          $query->where('nama_smartlocker', 'ilike', '%' . $nama_smartlocker . '%');
        }
      }


      if ($request->has('status_smartlocker')) {
        $status_smartlocker = $request->input('status_smartlocker');
        if (is_array($status_smartlocker)) {
          $query->whereIn('status_smartlocker', $status_smartlocker);
        } else {
          $query->where('status_smartlocker', 'ilike', '%' . $status_smartlocker . '%');
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
      $smartlockerData = $query->get();

      $total_smartlocker = $smartlockerData->count();
      $totalaktif = $smartlockerData->where('status_smartlocker', 'aktif')->count();
      $totalnonaktif = $smartlockerData->where('status_smartlocker', 'nonaktif')->count();

      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = SmartLockerResource::collection($paginatedData);

      $responseData = [
        "status" => "OK",
        "message" => "Successfully get Data",
        "records" => $resourceCollection->toArray($request),
        "total_smartlocker$total_smartlocker" => $total_smartlocker,
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

  public function store(SmartlockerRequest $request)
  {
    try {
      if (SmartLockerModel::where('gmac', $request->gmac)->exists()) {
        return ApiResponse::error('Failed to create smartlocker.', 'Gmac already exists.');
      }

      $smartlocker = new SmartLockerModel([
        'gmac' => $request->gmac,
        'nama_smartlocker' => $request->nama_smartlocker,
        'ruangan_otmil_id' => $request->ruangan_otmil_id,
        'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
        'status_smartlocker' => $request->status_smartlocker,
        'v_smartlocker_topic' => $request->v_smartlocker_topic,
        'posisi_X' => $request->posisi_X,
        'posisi_Y' => $request->posisi_Y
      ]);

      $smartlocker->save();

      return ApiResponse::created($smartlocker);
    } catch (Exception $e) {
      return ApiResponse::error('Failed to create smartlocker.', $e->getMessage());
    }
  }

  public function update(SmartlockerRequest $request)
  {
    try {
      $id = $request->input('smartlocker_id');
      $smartlocker = SmartLockerModel::findOrFail($id);
      $smartlocker->gmac = $request->gmac;
      $smartlocker->nama_smartlocker = $request->nama_smartlocker;
      $smartlocker->ruangan_otmil_id = $request->ruangan_otmil_id;
      $smartlocker->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
      $smartlocker->status_smartlocker = $request->status_smartlocker;
      $smartlocker->v_smartlocker_topic = $request->v_smartlocker_topic;

      $smartlocker->save();

      return ApiResponse::updated($smartlocker);
    } catch (Exception $e) {
      return ApiResponse::error('Failed to update Face Rec.', $e->getMessage());
    }
  }

  public function destroy(Request $request)
  {
    try {
      $id = $request->input('smartlocker_id');
      $FaceRec = SmartLockerModel::findOrFail($id);
      if (!$FaceRec) {
        return ApiResponse::error('smartlocker not found.', 'smartlocker not found.', 404);
      }
      $FaceRec->delete();
      return ApiResponse::deleted();
    } catch (Exception $e) {
      return ApiResponse::error('Failed to delete smartlocker.', $e->getMessage());
    }
  }
}
