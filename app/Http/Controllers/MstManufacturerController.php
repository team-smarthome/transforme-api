<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\MstManufacturerRequest;
use App\Http\Resources\MstManufacturerResource;
use App\Models\Mst_manufacturer;
use App\Models\Platform;
use Exception;
use Illuminate\Http\Request;

class MstManufacturerController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = Mst_manufacturer::with(['platform']);
      $filter = [
        'manufacture' => 'manufacture',
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
      $resourceCollection = MstManufacturerResource::collection($paginatedData);

      return ApiResponse::pagination($resourceCollection);
    } catch (\Exception $e) {
      return ApiResponse::error('Failed to get Data.', $e->getMessage());
    }
  }

  public function store(MstManufacturerRequest $request)
  {
    try {
      $manufacture =  new Mst_manufacturer([
        'manufacture' => $request->manufacture,
        'platform_id' => $request->platform_id
      ]);

      // if (Platform::where('platform', $request->platform)->exists()) {
      //     return ApiResponse::error('Failed to create Platform.', 'Platform already exists.');
      // }

      if ($manufacture->save()) {
        return ApiResponse::created($manufacture);
      } else {
        return ApiResponse::error('Failed to create Platform.', 'Unknown error.');
      }
    } catch (Exception $e) {
      return ApiResponse::error('Failed to create Platform.', $e->getMessage());
    }
  }

  public function update(MstManufacturerRequest $request)
  {
    try {
      $id = $request->input('manufacturer_id');
      $manufacture = Mst_manufacturer::find($id);
      if (!$manufacture) {
        return ApiResponse::error('Failed to update Manufacture.', 'Manufacture not found.');
      }

      $manufacture->manufacture = $request->manufacture;
      $manufacture->platform_id = $request->platform_id;

      if ($manufacture->save()) {
        return ApiResponse::updated($manufacture);
        return ApiResponse::error('Failed to update Manufacture.', 'Unknown error.');
      }
    } catch (Exception $e) {
      return ApiResponse::error('Failed to update Manufacture.', $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request)
  {
    try {
      $id = $request->input('manufacturer_id');
      $manufacture = Mst_manufacturer::find($id);
      if (!$manufacture) {
        return ApiResponse::error('Failed to delete Manufacture.', 'Manufacture not found.');
      }

      if ($manufacture->delete()) {
        return ApiResponse::deleted();
      } else {
        return ApiResponse::error('Failed to delete Manufacture.', 'Unknown error.');
      }
    } catch (Exception $e) {
      return ApiResponse::error('Failed to delete Manufacture.', $e->getMessage());
    }
  }
}
