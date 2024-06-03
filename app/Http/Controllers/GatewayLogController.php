<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GatewayLog;
use App\Http\Requests\GatewayLogRequest;
use App\Helpers\ApiResponse;
use Exception;

class GatewayLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $query = GatewayLog::with([
                'gateway' => function ($join_query) {
                    $join_query->select('id', 'nama_gateway', 'status_gateway', 'gmac', 'ruangan_lemasmil_id', 'ruangan_otmil_id')
                        ->with([
                            'ruanganLemasmil' => function($join_query) {
                                $join_query->select('id', 'nama_ruangan_lemasmil', 'jenis_ruangan_lemasmil', 'zona_id', 'lokasi_lemasmil_id')
                                    ->with('zona:id,nama_zona')
                                    ->with('lokasiLemasMil:id,nama_lokasi_lemasmil');
                            },
                            'ruanganOtmil' => function ($join_query) {
                                $join_query->select('id', 'nama_ruangan_otmil', 'jenis_ruangan_otmil', 'zona_id', 'lokasi_otmil_id')
                                    ->with('zona:id,nama_zona')
                                    ->with('lokasiOtmil:id,nama_lokasi_otmil');
                            }
                        ]);
                },
                'wbpProfile:id,nama'
            ]);
            // ->select('id', 'image', 'gateway_id', 'wbp_profile_id')
            // ->get();
    
            $filterableColumns = [
                'gateway_id' => 'gateway_id',
                'wbp_profile_id' => 'wbp_profile_id'
            ];
    
            foreach ($filterableColumns as $requestKey => $column) {
                if ($value = request($requestKey)) {
                    $query->where($column, 'like', '%' . $value . '%');
                }
            }
    
            // return ApiResponse::success($query);

            $query->latest();
            return ApiResponse::paginate($query);
        } catch (Exception $e) {
            return ApiResponse::error($e);
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
    public function store(GatewayLogRequest $request)
    {
        try {
            $gatewayLog = new GatewayLog([
                'wbp_profile_id' => $request->wbp_profile_id,
                'gateway_id' => $request->gateway_id
            ]);

            if ($request->hasFile('image')) {
                $gambarPath = $request->file('image')->store('public/gateway_log_image');
                $gatewayLog->image = str_replace('public/', '', $gambarPath);
            }

            $gatewayLog->save();
            return ApiResponse::created($gatewayLog);

        } catch (Exception $e) {
            return ApiResponse::error($e);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('gateway_log_id');
            $gatewayLog = GatewayLog::findOrFail($id);
            if (!$gatewayLog) {
                return ApiResponse::error('Gateway Log not found.');
            }

            if ($gatewayLog->delete()) {
                return ApiResponse::deleted();
            } else {
                return ApiResponse::error('Failed to delete Gateway Log.', 'Failed to delete Gateway Log.');
            }

        } catch (Exception $e) {
            return ApiResponse::error($e);
        }
    }
}
