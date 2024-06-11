<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gateway;
use App\Http\Requests\GatewayRequest;
use App\Http\Resources\GatewayResource;
use App\Helpers\ApiResponse;
use Exception;

class GatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Gateway::with(['ruanganOtmil.zona', 'ruanganLemasmil.zona', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);
            $filterableColumns = [
                'gateway_id' => 'id',
                'gmac' => 'gmac',
                'nama_gateway' => 'nama_gateway',
                'ruangan_otmil_id' => 'ruangan_otmil_id',
                'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
                'jenis_ruangan_otmil' => 'ruanganOtmil.jenis_ruangan_otmil',
                'lokasi_otmil_id' => 'ruanganOtmil.lokasiOtmil.lokasi_otmil_id',
                'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
                'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan_lemasmil',
                'jenis_ruangalemasmilil' => 'ruanganLemasmil.jenis_ruangan_lemasmil',
                'status_gateway' => 'status_gateway',
                'v_gateway_topic' => 'v_gateway_topic'
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    if ($requestKey === 'nama_ruangan_otmil') {
                        $query->whereHas('ruanganOtmil', function ($q) use ($filters, $requestKey) {
                            $q->where('nama_ruangan_otmil', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } elseif ($requestKey === 'nama_ruangan_lemasmil') {
                        $query->whereHas('ruanganLemasmil', function ($q) use ($filters, $requestKey) {
                            $q->where('nama_ruangan_lemasmil', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } elseif ($requestKey === 'jenis_ruangan_otmil') {
                        $query->whereHas('ruanganOtmil', function ($q) use ($filters, $requestKey) {
                            $q->where('jenis_ruangan_otmil', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } elseif ($requestKey === 'jenis_ruangan_lemasmil') {
                        $query->whereHas('ruanganLemasmil', function ($q) use ($filters, $requestKey) {
                            $q->where('jenis_ruangan_lemasmil', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } elseif ($requestKey === 'lokasi_otmil_id') {
                        $query->whereHas('ruanganOtmil.lokasiOtmil', function ($q) use ($filters, $requestKey) {
                            $q->where('lokasi_otmil_id', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } elseif ($requestKey === 'lokasi_lemasmil_id') {
                        $query->whereHas('ruanganLemasmil.lokasiLemasmil', function ($q) use ($filters, $requestKey) {
                            $q->where('lokasi_lemasmil_id', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } else {
                        $query->where($column, 'LIKE', '%' . $filters[$key] . '%');
                    }
                }
            }
            $query->latest();
            $gatewayData = $query->get();

            $totalGateway = $gatewayData->count();
            $totalaktif = $gatewayData->where('status_gateway', 'aktif')->count();
            $totalnonaktif = $gatewayData->where('status_gateway', 'nonaktif')->count();

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = GatewayResource::collection($paginatedData);

            $responseData = [
                "status" => "OK",
                "message" => "Successfully get Data",
                "records" => $resourceCollection->toArray($request),
                "totalGateway" => $totalGateway,
                "totalaktif" => $totalaktif,
                "totalnonaktif" => $totalnonaktif,
                "pagination" => [
                    "currentPage" => $paginatedData->currentPage(),
                    "pageSize" => $paginatedData->perPage(),
                    "from" => $paginatedData->firstItem(),
                    "to" => $paginatedData->lastItem(),
                    "totalRecords" => $paginatedData->total(),
                    "totalPages" => $paginatedData->lastPage()
                ]
            ];

            return response()->json($responseData);
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
            // Periksa apakah gmac sudah ada
            if (Gateway::where('gmac', $request->gmac)->exists()) {
                return ApiResponse::error('Failed to create Gateway.', 'Gmac already exists.');
            }

            // Buat objek Gateway baru
            $gateway = new Gateway([
                'gmac' => $request->gmac,
                'nama_gateway' => $request->nama_gateway,
                'ruangan_otmil_id' => $request->ruangan_otmil_id,
                'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
                'status_gateway' => $request->status_gateway,
                'v_gateway_topic' => $request->v_gateway_topic
            ]);

            // Simpan gateway
            if ($gateway->save()) {
                $data = $gateway->toArray();
                $formattedData = array_merge(['id' => $gateway->id], $data);
                return ApiResponse::created($formattedData);
            }
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
            $gateway->gmac = $request->gmac;
            $gateway->nama_gateway = $request->nama_gateway;
            $gateway->ruangan_otmil_id = $request->ruangan_otmil_id;
            $gateway->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $gateway->status_gateway = $request->status_gateway;
            $gateway->v_gateway_topic = $request->v_gateway_topic;

            if ($gateway->save()) {
                $data = $gateway->toArray();
                return ApiResponse::updated($data);
            }
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
            if (!$gateway) {
                return ApiResponse::error('Gateway not found.', 'Gateway not found.', 404);
            }
            $gateway->delete();
            return ApiResponse::deleted();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete Gateway.', $e->getMessage());
        }
    }
}
