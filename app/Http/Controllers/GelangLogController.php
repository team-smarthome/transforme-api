<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\GelangLogRequest;
use App\Http\Resources\GelangLogResource;
use App\Http\Resources\GelangResource;
use App\Models\GelangLog;
use Illuminate\Http\Request;

class GelangLogController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        try {
            $query = GelangLog::with('gelangLog');

            $paginateData = $query->paginate($perPage);
            return ApiResponse::success([
                'data' => GelangResource::collection($paginateData),
                'pagination' => [
                    'total' => $paginateData->total(),
                    'per_page' => $paginateData->perPage(),
                    'current_page' => $paginateData->currentPage(),
                    'last_page' => $paginateData->lastPage(),
                    'from' => $paginateData->firstItem(),
                    'to' => $paginateData->lastItem(),
                ]
            ]);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get data.', $e->getMessage());
        }
    }

    public function store(GelangLogRequest $request)
    {
        $request->validate([
            'gelang_id' => 'nullable|string',
            'v_gmac' => 'nullable|string',
            'v_dmac' => 'nullable|string',
            'v_vbatt' => 'nullable|string',
            'v_step' => 'nullable|string',
            'v_heartrate' => 'nullable|string',
            'v_temp' => 'nullable|string',
            'v_spo' => 'nullable|string',
            'v_systolic' => 'nullable|string',
            'v_diastolic' => 'nullable|string',
            'v_rssi' => 'nullable|string',
            'n_cutoff_flag' => 'nullable|integer',
            'n_type' => 'nullable|integer',
            'v_x0' => 'nullable|string',
            'v_y0' => 'nullable|string',
            'v_z0' => 'nullable|string',
            'd_time' => 'date',
            'n_isavailable' => 'required|integer',
            'v_gateway_topic' => 'nullable|string',
        ]);

        $dataGelangLog = GelangLog::create($request->all());

        return ApiResponse::created([
            'data' => new GelangLogResource($dataGelangLog)
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'gelang_id' => 'nullable|string',
            'v_gmac' => 'nullable|string',
            'v_dmac' => 'nullable|string',
            'v_vbatt' => 'nullable|string',
            'v_step' => 'nullable|string',
            'v_heartrate' => 'nullable|string',
            'v_temp' => 'nullable|string',
            'v_spo' => 'nullable|string',
            'v_systolic' => 'nullable|string',
            'v_diastolic' => 'nullable|string',
            'v_rssi' => 'nullable|string',
            'n_cutoff_flag' => 'nullable|integer',
            'n_type' => 'nullable|integer',
            'v_x0' => 'nullable|string',
            'v_y0' => 'nullable|string',
            'v_z0' => 'nullable|string',
            'd_time' => 'date',
            'n_isavailable' => 'required|integer',
            'v_gateway_topic' => 'nullable|string',
        ]);

        $gelangLog_id = $request->input('gelang_log_id');
        $dataGelangLog = GelangLog::where('id', $gelangLog_id)->firstOrFail();
        $dataGelangLog->update($request->all());

        return ApiResponse::updated([
            'data' => new GelangLogResource($dataGelangLog)
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'gelang_log_id' => 'required|string|max:36'
        ]);

        $gelangLog_id = $request->input('gelang_log_id');
        $dataGelang = GelangLog::where('id', $gelangLog_id)->firstOrFail();
        $dataGelang->delete();

        return ApiResponse::deleted([
            'message' => 'Data deleted successfully'
        ]);
    }
}
