<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\DeviceModel;
use App\Http\Resources\DeviceModelResource;
use Illuminate\Database\QueryException;
use Exception;
use App\Http\Requests\DeviceModelRequest;
use Illuminate\Support\Facades\DB;

class DeviceModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = DeviceModel::query();
            $filterableColumns = [
                'device_model_id' => 'id',
                'model' => 'model',
                'platform_id' => 'platform_id',
            ];

            foreach ($filterableColumns as $requestKey => $column) {
                if ($request->has($requestKey)) {
                    $query->where($column, 'like', '%' . $request->input($requestKey) . '%');
                }
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
                        
            $resourceCollection = DeviceModelResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection);

        } catch (Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(DeviceModelRequest $request)
    {

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(DeviceModelRequest $request)
    {
        try {
            DB::beginTransaction();
            $deviceModel = new DeviceModel();
            $deviceModel->model = $request->model;
            $deviceModel->platform_id = $request->platform_id;
            $deviceModel->save();
            DB::commit();

            return ApiResponse::created();

        } catch (Exception $e) {
            return ApiResponse::error('Failed to store Device Model.', $e->getMessage());
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
    public function update(DeviceModelRequest $request)
    {
        try {
            $deviceModel = DeviceModel::find($request->device_model_id);
            $deviceModel->model = $request->model;
            $deviceModel->platform_id = $request->platform_id;
            $deviceModel->save();

            return ApiResponse::updated();
        } catch (QueryException $e) {
            return ApiResponse::error('Failed to update Device Model.', $e->getMessage());
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
         try {
            DB::beginTransaction();
            $device = DeviceModel::find($reqeust->input('device_mode_id'));
            $device->delete();
            DB::commit();

            return ApiResponse::deleted();
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::error($e->getMessage());
        }
    }
}
