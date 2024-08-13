<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\FirmwareRequest;
use App\Http\Resources\FirmwareResource;
use App\Models\Firmware;
use Exception;
use Illuminate\Http\Request;

class FirmwareController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = Firmware::with(['platform']);
      $filter = [
        'version' => 'version',
        'platform_id' => 'platform_id',
        'nama_platform' => 'platform.nama_platform'
      ];

      foreach ($filter as $requestKey => $column) {
        if ($request->has($requestKey)) {
          if ($column == 'platform.nama_platform') {
            $query->whereHas('platform', function ($q) use ($request, $requestKey) {
              $q->where('nama_platform', 'ILIKE', '%' . $request->input($requestKey) . '%');
            });
          } else {
            $query->where($column, 'ILIKE', '%' . $request->input($requestKey) . '%');
          }
        }
      }

      $query->latest();

      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = FirmwareResource::collection($paginatedData);

      return ApiResponse::pagination($resourceCollection);
    } catch (\Exception $e) {
      return ApiResponse::error('Failed to get Data.', $e->getMessage());
    }
  }


  public function store(FirmwareRequest $request)
  {
    try {
      $firmware =  new Firmware([
        'version' => $request->version,
        'platform_id' => $request->platform_id
      ]);

      if ($firmware->save()) {
        return ApiResponse::created($firmware);
      } else {
        return ApiResponse::error('Failed to create Firmware.', 'Unknown error.');
      }
    } catch (Exception $e) {
      return ApiResponse::error('Failed to create Firmware.', $e->getMessage());
    }
  }

  public function update(FirmwareRequest $request)
  {
    try {
      $id = $request->input('firmware_version_id');
      $firmware = Firmware::find($id);
      if (!$firmware) {
        return ApiResponse::error('Failed to update version.', 'version not found.');
      }

      $firmware->version = $request->version;
      $firmware->platform_id = $request->platform_id;

      if ($firmware->save()) {
        return ApiResponse::updated($firmware);
        return ApiResponse::error('Failed to update version.', 'Unknown error.');
      }
    } catch (Exception $e) {
      return ApiResponse::error('Failed to update version.', $e->getMessage());
    }
  }

  // /**
  //  * Remove the specified resource from storage.
  //  */
  public function destroy(Request $request)
  {
    try {
      $id = $request->input('firmware_version_id');
      $firmware = Firmware::find($id);
      if (!$firmware) {
        return ApiResponse::error('Failed to delete firmware.', 'firmware not found.');
      }

      if ($firmware->delete()) {
        return ApiResponse::deleted();
      } else {
        return ApiResponse::error('Failed to delete firmware.', 'Unknown error.');
      }
    } catch (Exception $e) {
      return ApiResponse::error('Failed to delete firmware.', $e->getMessage());
    }
  }
}
