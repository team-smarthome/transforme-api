<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gateway;
use App\Http\Requests\GatewayRequest;
use App\Helpers\ApiResponse;
use Exception;

class GatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $query = Gateway::with(['ruanganOtmil', 'ruanganLemasmil']);
            $filterableColumns = [
                'gmac' => 'gmac',
                'nama_gateway' => 'nama_gateway',
                'ruangan_otmil_id' => 'ruangan_otmil_id',
                'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
                'status_gateway' => 'status_gateway',
                'v_gateway_topic' => 'v_gateway_topic'
            ];
            foreach ($filterableColumns as $requestKey => $column) {
                if ($value = request($requestKey)) {
                    $query->where($column, 'like', '%' . $value . '%');
                }
            }

            $query->latest();
            return ApiResponse::paginate($query);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
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
    public function store(GatewayRequest $request)
    {
        try {
            $data = $request->validated();
            $gateway = Gateway::create($data);
            return ApiResponse::success($gateway, 'Gateway created successfully.');
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create Gateway.', $e->getMessage());
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
    public function update(GatewayRequest $request)
    {
        try {
            $id = $request->input('gateway_id');
            $gateway = Gateway::findOrFail($id);
            $gateway->update($data);
            return ApiResponse::success($gateway, 'Gateway updated successfully.');
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update Gateway.', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('gateway_id');
            $gateway = Gateway::findOrFail($id);
            $gateway->delete();
            return ApiResponse::success(null, 'Gateway deleted successfully.');
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete Gateway.', $e->getMessage());
        }
    }
}
