<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceTypeRequest;
use App\Http\Resources\DeviceTypeResource;
use App\Models\DeviceType;
use Exception;
use Illuminate\Http\Request;

class DeviceTypeController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = DeviceType::with(['platform']);
      $filter = [
        'type' => 'type',
        'platform_id' => 'platform_id',
        'platform' => 'platform.platform'
      ];

      foreach ($filter as $requestKey => $column) {
        if ($request->has($requestKey)) {
          $query->where($column, 'ILIKE', '%' . $request->input($requestKey) . '%');
        }
      }

      if ($request->has('platform')) {
        $query->whereHas('platform', function ($q) use ($request) {
          $q->where('platform', 'ILIKE', '%' . $request->input('platform') . '%');
        });
      }

      $query->latest();
      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = DeviceTypeResource::collection($paginatedData);

      return ApiResponse::pagination($resourceCollection);
    } catch (\Exception $e) {
      return ApiResponse::error('Failed to get Data.', $e->getMessage());
    }
  }

  public function store(DeviceTypeRequest $request)
  {
    try {
      $type =  new DeviceType([
        'type' => $request->type,
        'platform_id' => $request->platform_id
      ]);

      if ($type->save()) {
        return ApiResponse::created($type);
      } else {
        return ApiResponse::error('Failed to create Platform.', 'Unknown error.');
      }
    } catch (Exception $e) {
      return ApiResponse::error('Failed to create Platform.', $e->getMessage());
    }
  }

  public function update(DeviceTypeRequest $request)
  {
    try {
      $device_type_id = $request->input('device_type_id');
      $type = DeviceType::find($device_type_id);
      if (!$type) {
        return ApiResponse::error('Failed to update type.', 'type not found.');
      }

      $type->type = $request->type;
      $type->platform_id = $request->platform_id;

      if ($type->save()) {
        return ApiResponse::updated($type);
        return ApiResponse::error('Failed to update type.', 'Unknown error.');
      }
    } catch (Exception $e) {
      return ApiResponse::error('Failed to update type.', $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request)
  {
    try {
      $device_type_id = $request->input('device_type_id');
      $type = DeviceType::find($device_type_id);
      if (!$type) {
        return ApiResponse::error('Failed to delete type.', 'type not found.');
      }

      if ($type->delete()) {
        return ApiResponse::deleted();
      } else {
        return ApiResponse::error('Failed to delete type.', 'Unknown error.');
      }
    } catch (Exception $e) {
      return ApiResponse::error('Failed to delete type.', $e->getMessage());
    }
  }
}
