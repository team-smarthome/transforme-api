<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\NASRequest;
use App\Http\Resources\NASResource;
use App\Models\NAS;
use Exception;
use Illuminate\Http\Request;

class NASController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = NAS::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);
            $filterableColumns = [
                'lokasi_otmil_id' => 'ruanganOtmil.lokasiOtmil.lokasi_otmil_id',
                'lokasi_lemasmil_id' => 'ruanganLemasmil.lokasiLemasmil.lokasi_lemasmil_id',
                'ruangan_otmil_id' => 'ruangan_otmil_id',
                'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
                'gmac' => 'gmac',
                'nama_nas' => 'nama_nas',
                'model' => 'model',
                'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
                'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan_lemasmil',
                'jenis_ruangan_otmil' => 'ruanganOtmil.jenis_ruangan_otmil',
                'jenis_ruangan_lemasmil' => 'ruanganLemasmil.jenis_ruangan_lemasmil',
                'status_nas' => 'status_nas'
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
            $nas = $query->get();

            $totalNAS = $nas->count();
            $totalaktif = $nas->where('status_nas', 'aktif')->count();
            $totalnonaktif = $nas->where('status_nas', 'nonaktif')->count();

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = NASResource::collection($paginatedData);

            $responseData = [
                "status" => "OK",
                "message" => "Successfully get Data",
                "records" => $resourceCollection->toArray($request),
                "totalNAS" => $totalNAS,
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

    public function store(NASRequest $request)
    {
        try {
            if (NAS::where('gmac', $request->gmac)->exists()) {
                return ApiResponse::error('Failed to create NAS.', 'Gmac already exists.');
            }

            $nas = new NAS([
                'gmac' => $request->gmac,
                'nama_nas' => $request->nama_nas,
                'ruangan_otmil_id' => $request->ruangan_otmil_id,
                'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
                'status_nas' => $request->status_nas,
                'v_nas_topic' => $request->v_nas_topic
            ]);

            if ($nas->save()) {
                $data = $nas->toArray();
                $formattedData = array_merge(['id' => $nas->id], $data);
                return ApiResponse::created($formattedData);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create NAS.', $e->getMessage());
        }
    }

    public function update(NASRequest $request)
    {
        try {
            $id = $request->input('nas_id');
            $nas = NAS::findOrFail($id);
            $nas->gmac = $request->gmac;
            $nas->nama_nas = $request->nama_nas;
            $nas->ruangan_otmil_id = $request->ruangan_otmil_id;
            $nas->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $nas->status_nas = $request->status_nas;
            $nas->v_nas_topic = $request->v_nas_topic;

            if ($nas->save()) {
                $data = $nas->toArray();
                return ApiResponse::updated($data);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update NAS.', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->input('nas_id');
            $nas = NAS::findOrFail($id);
            if (!$nas) {
                return ApiResponse::error('NAS not found.', 'NAS not found.', 404);
            }
            $nas->delete();
            return ApiResponse::deleted();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete NAS.', $e->getMessage());
        }
    }
}
