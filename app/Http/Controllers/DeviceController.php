<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Http\Resources\DeviceResource;
use App\Helpers\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DeviceRequest;
use Exception;


class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    try {
        $query = Device::with(['deviceType', 'deviceModel', 'manufacturer', 'firmwareVersion', 'platform']);

        $filterableColumns = [
            'device_id' => 'id',
            'imei' => 'imei',
            'wearer_name' => 'wearer_name',
            'health_data_periodic' => 'health_data_periodic',
            'status' => 'status',
            'is_used' => 'is_used',
            'device_type_id' => 'device_type_id',
            'device_model_id' => 'device_model_id',
            'manufacturer_id' => 'manufacturer_id',
            'firmware_version_id' => 'firmware_version_id',
            'platform_id' => 'platform_id',
        ];

        foreach ($filterableColumns as $key => $value) {
        if ($request->has($key) && $request->input($key) !== '') {
            $query->where($value, 'like', '%' . $request->input($key) . '%');
            }
        }


        $query->latest();
        $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
        $resourceCollection = DeviceResource::collection($paginatedData);

        return ApiResponse::pagination($resourceCollection);

    } catch (\Exception $e) {
        return ApiResponse::error($e->getMessage());
    }
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeviceRequest $request)
    {
        try {
            DB::beginTransaction();
            $device = new Device();
            $device->imei = $request->input('imei');
            $device->wearer_name = $request->input('wearer_name');
            $device->health_data_periodic = $request->input('health_data_periodic');
            $device->status = $request->input('status');
            $device->is_used = $request->input('is_used');
            $device->device_type_id = $request->input('device_type_id');
            $device->device_model_id = $request->input('device_model_id');
            $device->manufacturer_id = $request->input('manufacturer_id');
            $device->firmware_version_id = $request->input('firmware_version_id');
            $device->platform_id = $request->input('platform_id');
            $device->save();
            DB::commit();

            return ApiResponse::created();
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeviceRequest $request)
    {
        try {
            DB::beginTransaction();
            $device = Device::find($request->input('device_id'));
            $device->imei = $request->input('imei');
            $device->wearer_name = $request->input('wearer_name');
            $device->health_data_periodic = $request->input('health_data_periodic');
            $device->status = $request->input('status');
            $device->is_used = $request->input('is_used');
            $device->device_type_id = $request->input('device_type_id');
            $device->device_model_id = $request->input('device_model_id');
            $device->manufacturer_id = $request->input('manufacturer_id');
            $device->firmware_version_id = $request->input('firmware_version_id');
            $device->platform_id = $request->input('platform_id');
            $device->save();
            DB::commit();

            return ApiResponse::updated();
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $reqeust)
    {
        try {
            DB::beginTransaction();
            $device = Device::find($reqeust->input('device_id'));
            $device->delete();
            DB::commit();

            return ApiResponse::deleted();
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::error($e->getMessage());
        }
    }
}
