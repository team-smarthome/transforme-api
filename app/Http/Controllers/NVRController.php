<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\NVRRequest;
use App\Http\Resources\NVRResource;
use App\Models\NVR;
use Exception;
use Illuminate\Http\Request;

class NVRController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = NVR::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);
            $filterableColumns = [
                'lokasi_otmil_id' => 'ruanganOtmil.lokasiOtmil.lokasi_otmil_id',
                'lokasi_lemasmil_id' => 'ruanganLemasmil.lokasiLemasmil.lokasi_lemasmil_id',
                'ruangan_otmil_id' => 'ruangan_otmil_id',
                'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
                'gmac' => 'gmac',
                'nama_nvr' => 'nama_nvr',
                'model' => 'model',
                'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
                'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan_lemasmil',
                'jenis_ruangan_otmil' => 'ruanganOtmil.jenis_ruangan_otmil',
                'jenis_ruangan_lemasmil' => 'ruanganLemasmil.jenis_ruangan_lemasmil',
                'status_nvr' => 'status_nvr'
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
            $nvr = $query->get();

            $totalNVR = $nvr->count();
            $totalaktif = $nvr->where('status_nvr', 'aktif')->count();
            $totalnonaktif = $nvr->where('status_nvr', 'nonaktif')->count();

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = NVRResource::collection($paginatedData);

            $responseData = [
                "status" => "OK",
                "message" => "Successfully get Data",
                "records" => $resourceCollection->toArray($request),
                "totalNVR" => $totalNVR,
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

    public function store(NVRRequest $request)
    {
        try {
            if (NVR::where('gmac', $request->gmac)->exists()) {
                return ApiResponse::error('Failed to create Face Rec.', 'Gmac already exists.');
            }

            $FaceRec = new NVR([
                'gmac' => $request->gmac,
                'nama_nvr' => $request->nama_nvr,
                'ruangan_otmil_id' => $request->ruangan_otmil_id,
                'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
                'status_nvr' => $request->status_nvr,
                'v_nvr_topic' => $request->v_nvr_topic
            ]);

            if ($FaceRec->save()) {
                $data = $FaceRec->toArray();
                $formattedData = array_merge(['id' => $FaceRec->id], $data);
                return ApiResponse::created($formattedData);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create Face Rec.', $e->getMessage());
        }
    }

    public function update(NVRRequest $request)
    {
        try {
            $id = $request->input('nvr_id');
            $nvr = NVR::findOrFail($id);
            $nvr->gmac = $request->gmac;
            $nvr->nama_nvr = $request->nama_nvr;
            $nvr->ruangan_otmil_id = $request->ruangan_otmil_id;
            $nvr->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $nvr->status_nvr = $request->status_nvr;
            $nvr->v_nvr_topic = $request->v_nvr_topic;

            if ($nvr->save()) {
                $data = $nvr->toArray();
                return ApiResponse::updated($data);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update NVR.', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->input('nvr_id');
            $nvr = NVR::findOrFail($id);
            if (!$nvr) {
                return ApiResponse::error('NVR not found.', 'NVR not found.', 404);
            }
            $nvr->delete();
            return ApiResponse::deleted();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete NVR.', $e->getMessage());
        }
    }
}
