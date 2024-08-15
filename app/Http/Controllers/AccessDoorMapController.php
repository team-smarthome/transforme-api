<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccessDoorRequest;
use App\Http\Resources\AccessDoorResource;
use App\Models\AccessDoor;
use Exception;
use Illuminate\Http\Request;

class AccessDoorMapController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = AccessDoor::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);
      $filterableColumns = [
        'lokasi_otmil_id' => 'ruanganOtmil.lokasiOtmil.lokasi_otmil_id',
        'lokasi_lemasmil_id' => 'ruanganLemasmil.lokasiLemasmil.lokasi_lemasmil_id',
        'ruangan_otmil_id' => 'ruangan_otmil_id',
        'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
        'gmac' => 'gmac',
        'nama_access_door' => 'nama_access_door',
        'model' => 'model',
        'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
        'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan_lemasmil',
        'jenis_ruangan_otmil' => 'ruanganOtmil.jenis_ruangan_otmil',
        'jenis_ruangan_lemasmil' => 'ruanganLemasmil.jenis_ruangan_lemasmil',
        'status_access_door' => 'status_access_door'
      ];

      if ($request->has('nama_access_door')) {
        $nama_access_door = $request->input('nama_access_door');
        if (is_array($nama_access_door)) {
          $query->whereIn('nama_access_door', $nama_access_door);
        } else {
          $query->where('nama_access_door', 'ilike', '%' . $nama_access_door . '%');
        }
      }
      if ($request->has('status_access_door')) {
        $status_access_door = $request->input('status_access_door');
        if (is_array($status_access_door)) {
          $query->whereIn('status_access_door', $status_access_door);
        } else {
          $query->where('status_access_door', 'ilike', '%' . $status_access_door . '%');
        }
      }

      $query->latest();
      $accessdoorData = $query->get();

      $totalAccessDoor = $accessdoorData->count();
      $totalaktif = $accessdoorData->where('status_access_door', 'aktif')->count();
      $totalnonaktif = $accessdoorData->where('status_access_door', 'nonaktif')->count();

      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = AccessDoorResource::collection($paginatedData);

      $responseData = [
        "status" => "OK",
        "message" => "Successfully get Data",
        "records" => $resourceCollection->toArray($request),
        "totalAccessDoor" => $totalAccessDoor,
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

  public function store(AccessDoorRequest $request)
  {
    try {
      if (AccessDoor::where('gmac', $request->gmac)->exists()) {
        return ApiResponse::error('Failed to create Access Door.', 'Gmac already exists.');
      }

      $AccessDoor = new AccessDoor([
        'gmac' => $request->gmac,
        'nama_access_door' => $request->nama_access_door,
        'ruangan_otmil_id' => $request->ruangan_otmil_id,
        'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
        'status_access_door' => $request->status_access_door,
        'v_access_door_topic' => $request->v_access_door_topic
      ]);

      if ($AccessDoor->save()) {
        $data = $AccessDoor->toArray();
        $formattedData = array_merge(['id' => $AccessDoor->id], $data);
        return ApiResponse::created($formattedData);
      }
    } catch (Exception $e) {
      return ApiResponse::error('Failed to create Access Door.', $e->getMessage());
    }
  }

  public function update(AccessDoorRequest $request)
  {
    try {
      $id = $request->input('access_door_id');
      $accessDoor = AccessDoor::findOrFail($id);
      $accessDoor->gmac = $request->gmac;
      $accessDoor->nama_access_door = $request->nama_access_door;
      $accessDoor->ruangan_otmil_id = $request->ruangan_otmil_id;
      $accessDoor->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
      $accessDoor->status_access_door = $request->status_access_door;
      $accessDoor->v_access_door_topic = $request->v_access_door_topic;

      if ($accessDoor->save()) {
        $data = $accessDoor->toArray();
        return ApiResponse::updated($data);
      }
    } catch (Exception $e) {
      return ApiResponse::error('Failed to update access door.', $e->getMessage());
    }
  }

  public function destroy(Request $request)
  {
    try {
      $id = $request->input('access_door_id');
      $accessDoor = AccessDoor::findOrFail($id);
      if (!$accessDoor) {
        return ApiResponse::error('Access Door not found.', 'Access Door not found.', 404);
      }
      $accessDoor->delete();
      return ApiResponse::deleted();
    } catch (Exception $e) {
      return ApiResponse::error('Failed to delete Access Door.', $e->getMessage());
    }
  }
}
