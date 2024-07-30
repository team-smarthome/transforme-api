<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\FirmwareRequest;
use App\Http\Resources\FirmwareResource;
use App\Models\Firmware;
use Exception;
use Illuminate\Support\Facades\DB;


class FirmwareController extends Controller
{
 public function index(Request $request)
    {
        try {
            $query = Firmware::with(['platform']);
            $filter = [
                'version' => 'version',
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
            // Temukan DeviceModel berdasarkan ID
            $deviceModel = Firmware::find($request->input('firmware_version_id'));

            // Periksa jika deviceModel ditemukan
            if (!$deviceModel) {
                return ApiResponse::error('FirmWare not found.', 'The requested Device Model does not exist.', 404);
            }

            // Perbarui atribut pada deviceModel
            $deviceModel->version = $request->input('version');
            $deviceModel->platform_id = $request->input('platform_id');
            $deviceModel->save();

            return ApiResponse::updated();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update Device Model.', $e->getMessage());
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(Request $request)
    {
         try {
            DB::beginTransaction();
            $device = Firmware::find($request->input('firmware_version_id'));
            $device->delete();
            DB::commit();

            return ApiResponse::deleted();
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::error($e->getMessage());
        }
    }
}
