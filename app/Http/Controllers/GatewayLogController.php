<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GatewayLog;
use App\Http\Requests\GatewayLogRequest;
use App\Helpers\ApiResponse;
use App\Http\Resources\GatewayLogResource;
use Exception;

class GatewayLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = GatewayLog::with('wbpProfile', 'gateway.ruanganOtmil.lokasiOtmil', 'gateway.ruanganLemasmil.lokasiLemasmil');

            $filters = $request->input('filter', []);

            if (isset($filters['nama_gateway'])) {
                $query->whereHas('gateway', function ($q) use ($filters) {
                    $q->where('nama_gateway', 'LIKE', '%' . $filters['nama_gateway'] . '%');
                });
            }
            if (isset($filters['nama_wbp'])) {
                $query->whereHas('wbpProfile', function ($q) use ($filters) {
                    $q->where('nama', 'LIKE', '%' . $filters['nama_wbp'] . '%');
                });
            }

            //
            if (isset($filters['lokasi_otmil_id'])) {
                $query->whereHas('gateway.ruanganOtmil', function ($q) use ($filters) {
                    $q->where('lokasi_otmil_id', 'LIKE', '%' . $filters['lokasi_otmil_id'] . '%');
                });
            }
            if (isset($filters['lokasi_lemasmil_id'])) {
                $query->whereHas('gateway.ruanganLemasmil', function ($q) use ($filters) {
                    $q->where('lokasi_lemasmil_id', 'LIKE', '%' . $filters['lokasi_lemasmil_id'] . '%');
                });
            }
            if (isset($filters['nama_lokasi_otmil'])) {
                $query->whereHas('gateway.ruanganOtmil.lokasiOtmil', function ($q) use ($filters) {
                    $q->where('nama_lokasi_otmil', 'LIKE', '%' . $filters['nama_lokasi_otmil'] . '%');
                });
            }
            if (isset($filters['nama_lokasi_lemasmil'])) {
                $query->whereHas('gateway.ruanganLemasmil.lokasiLemasmil', function ($q) use ($filters) {
                    $q->where('nama_lokasi_lemasmil', 'LIKE', '%' . $filters['nama_lokasi_lemasmil'] . '%');
                });
            }
            if (isset($filters['ruangan_otmil_id'])) {
                $query->whereHas('gateway.ruanganOtmil', function ($q) use ($filters) {
                    $q->where('ruangan_otmil_id', 'LIKE', '%' . $filters['ruangan_otmil_id'] . '%');
                });
            }
            if (isset($filters['ruangan_lemasmil_id'])) {
                $query->whereHas('gateway.ruanganLemasmil', function ($q) use ($filters) {
                    $q->where('ruangan_lemasmil_id', 'LIKE', '%' . $filters['ruangan_lemasmil_id'] . '%');
                });
            }
            if (isset($filters['nama_ruangan_otmil'])) {
                $query->whereHas('gateway.ruanganOtmil', function ($q) use ($filters) {
                    $q->where('nama_ruangan_otmil', 'LIKE', '%' . $filters['nama_ruangan_otmil'] . '%');
                });
            }
            if (isset($filters['nama_ruangan_lemasmil'])) {
                $query->whereHas('gateway.ruanganLemasmil', function ($q) use ($filters) {
                    $q->where('nama_ruangan_lemasmil', 'LIKE', '%' . $filters['nama_ruangan_lemasmil'] . '%');
                });
            }
            if (isset($filters['jenis_ruangan_otmil'])) {
                $query->whereHas('gateway.ruanganOtmil', function ($q) use ($filters) {
                    $q->where('jenis_ruangan_otmil', 'LIKE', '%' . $filters['jenis_ruangan_otmil'] . '%');
                });
            }
            if (isset($filters['jenis_ruangan_lemasmil'])) {
                $query->whereHas('gateway.ruanganLemasmil', function ($q) use ($filters) {
                    $q->where('jenis_ruangan_lemasmil', 'LIKE', '%' . $filters['jenis_ruangan_lemasmil'] . '%');
                });
            }
            if (isset($filters['wbp_profile_id'])) {
                $query->whereHas('gateway.wbpProfile', function ($q) use ($filters) {
                    $q->where('wbp_profile_id', 'LIKE', '%' . $filters['wbp_profile_id'] . '%');
                });
            }
            if (isset($filters['gmac'])) {
                $query->whereHas('gateway', function ($q) use ($filters) {
                    $q->where('gmac', 'LIKE', '%' . $filters['gmac'] . '%');
                });
            }
            if (isset($filters['status_gateway'])) {
                $query->whereHas('gateway', function ($q) use ($filters) {
                    $q->where('status_gateway', 'LIKE', '%' . $filters['status_gateway'] . '%');
                });
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = GatewayLogResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
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
