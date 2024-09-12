<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\GateParkingRequest;
use App\Http\Resources\GateParkingResource;
use App\Models\GateParkingModel;
use Exception;
use Illuminate\Http\Request;

class GateParkingController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = GateParkingModel::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);

      if ($request->has('nama_gate_parking')) {
        $nama_gate_parking = $request->input('nama_gate_parking');
        if (is_array($nama_gate_parking)) {
          $query->whereIn('nama_gate_parking', $nama_gate_parking);
        } else {
          $query->where('nama_gate_parking', 'ilike', '%' . $nama_gate_parking . '%');
        }
      }


      if ($request->has('status_gate_parking')) {
        $status_gate_parking = $request->input('status_gate_parking');
        if (is_array($status_gate_parking)) {
          $query->whereIn('status_gate_parking', $status_gate_parking);
        } else {
          $query->where('status_gate_parking', 'ilike', '%' . $status_gate_parking . '%');
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
      $gateParkingData = $query->get();

      $total_gate_parking = $gateParkingData->count();
      $totalaktif = $gateParkingData->where('status_gate_parking', 'aktif')->count();
      $totalnonaktif = $gateParkingData->where('status_gate_parking', 'nonaktif')->count();

      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = GateParkingResource::collection($paginatedData);

      $responseData = [
        "status" => "OK",
        "message" => "Successfully get Data",
        "records" => $resourceCollection->toArray($request),
        "total_gate_parking$total_gate_parking" => $total_gate_parking,
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

  public function store(GateParkingRequest $request)
  {
    try {
      if (GateParkingModel::where('gmac', $request->gmac)->exists()) {
        return ApiResponse::error('Failed to create gate_parking.', 'Gmac already exists.');
      }

      $gate_parking = new GateParkingModel([
        'gmac' => $request->gmac,
        'nama_gate_parking' => $request->nama_gate_parking,
        'ruangan_otmil_id' => $request->ruangan_otmil_id,
        'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
        'status_gate_parking' => $request->status_gate_parking,
        'v_gate_parking_topic' => $request->v_gate_parking_topic,
        'posisi_X' => $request->posisi_X,
        'posisi_Y' => $request->posisi_Y
      ]);

      $gate_parking->save();

      return ApiResponse::created($gate_parking);
    } catch (Exception $e) {
      return ApiResponse::error('Failed to create gate_parking.', $e->getMessage());
    }
  }

  public function update(GateParkingRequest $request)
  {
    try {
      $id = $request->input('gate_parking_id');
      $gate_parking = GateParkingModel::findOrFail($id);
      $gate_parking->gmac = $request->gmac;
      $gate_parking->nama_gate_parking = $request->nama_gate_parking;
      $gate_parking->ruangan_otmil_id = $request->ruangan_otmil_id;
      $gate_parking->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
      $gate_parking->status_gate_parking = $request->status_gate_parking;
      $gate_parking->v_gate_parking_topic = $request->v_gate_parking_topic;

      $gate_parking->save();

      return ApiResponse::updated($gate_parking);
    } catch (Exception $e) {
      return ApiResponse::error('Failed to update Face Rec.', $e->getMessage());
    }
  }

  public function destroy(Request $request)
  {
    try {
      $id = $request->input('gate_parking_id');
      $FaceRec = GateParkingModel::findOrFail($id);
      if (!$FaceRec) {
        return ApiResponse::error('gate_parking not found.', 'gate_parking not found.', 404);
      }
      $FaceRec->delete();
      return ApiResponse::deleted();
    } catch (Exception $e) {
      return ApiResponse::error('Failed to delete gate_parking.', $e->getMessage());
    }
  }
}
