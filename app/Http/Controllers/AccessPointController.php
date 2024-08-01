<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccessPointRequest;
use App\Http\Resources\AccessPointResource;
use App\Http\Resources\DesktopResource;
use App\Models\AccessPoint;
use Exception;
use Illuminate\Http\Request;

class AccessPointController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = AccessPoint::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);
            $filterableColumns = [
                'lokasi_otmil_id' => 'ruanganOtmil.lokasiOtmil.lokasi_otmil_id',
                'lokasi_lemasmil_id' => 'ruanganLemasmil.lokasiLemasmil.lokasi_lemasmil_id',
                'ruangan_otmil_id' => 'ruangan_otmil_id',
                'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
                'gmac' => 'gmac',
                'nama_access_point' => 'nama_access_point',
                'model' => 'model',
                'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
                'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan_lemasmil',
                'jenis_ruangan_otmil' => 'ruanganOtmil.jenis_ruangan_otmil',
                'jenis_ruangan_lemasmil' => 'ruanganLemasmil.jenis_ruangan_lemasmil',
                'status_access_point' => 'status_access_point'
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
                        $query->where($column, 'LIKE', '%' . $filters[$requestKey] . '%');
                    }
                }
            }

            $query->latest();
            $accessPointData = $query->get();

            $totalAccessPoint = $accessPointData->count();
            $totalaktif = $accessPointData->where('status_access_point', 'aktif')->count();
            $totalnonaktif = $accessPointData->where('status_access_point', 'nonaktif')->count();

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = AccessPointResource::collection($paginatedData);

            $responseData = [
                "status" => "OK",
                "message" => "Successfully get Data",
                "records" => $resourceCollection->toArray($request),
                "totalAccessPoint" => $totalAccessPoint,
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

    public function store(AccessPointRequest $request)
    {
        try {
            if (AccessPoint::where('gmac', $request->gmac)->exists()) {
                return ApiResponse::error('Failed to create Access Point.', 'Gmac already exists.');
            }

            $AccessPoint = new AccessPoint([
                'gmac' => $request->gmac,
                'nama_access_point' => $request->nama_access_point,
                'model' => $request->model,
                'ruangan_otmil_id' => $request->ruangan_otmil_id,
                'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
                'status_access_point' => $request->status_access_point,
                'v_access_point_topic' => $request->v_access_point_topic
            ]);

            if ($AccessPoint->save()) {
                $data = $AccessPoint->toArray();
                $formattedData = array_merge(['id' => $AccessPoint->id], $data);
                return ApiResponse::created($formattedData);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create Access Point.', $e->getMessage());
        }
    }

    public function update(AccessPointRequest $request)
    {
        try {
            $id = $request->input('access_point_id');
            $accessPoint = AccessPoint::findOrFail($id);
            $accessPoint->gmac = $request->gmac;
            $accessPoint->nama_access_point = $request->nama_access_point;
            $accessPoint->ruangan_otmil_id = $request->ruangan_otmil_id;
            $accessPoint->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $accessPoint->status_access_point = $request->status_access_point;
            $accessPoint->v_access_point_topic = $request->v_access_point_topic;

            if ($accessPoint->save()) {
                $data = $accessPoint->toArray();
                return ApiResponse::updated($data);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update access_point.', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->input('access_point_id');
            $accessPoint = AccessPoint::findOrFail($id);
            if (!$accessPoint) {
                return ApiResponse::error('Access Point not found.', 'Access Point not found.', 404);
            }
            $accessPoint->delete();
            return ApiResponse::deleted();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete Access Point.', $e->getMessage());
        }
    }
}
