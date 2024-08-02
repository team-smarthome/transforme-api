<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\MkioskRequest;
use App\Http\Resources\MkioskResource;
use App\Models\Mkiosk;
use Exception;
use Illuminate\Http\Request;

class MkioskController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Mkiosk::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);
            $filterableColumns = [
                'lokasi_otmil_id' => 'ruanganOtmil.lokasiOtmil.lokasi_otmil_id',
                'lokasi_lemasmil_id' => 'ruanganLemasmil.lokasiLemasmil.lokasi_lemasmil_id',
                'ruangan_otmil_id' => 'ruangan_otmil_id',
                'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
                'gmac' => 'gmac',
                'nama_m_kiosk' => 'nama_m_kiosk',
                'model' => 'model',
                'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
                'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan_lemasmil',
                'jenis_ruangan_otmil' => 'ruanganOtmil.jenis_ruangan_otmil',
                'jenis_ruangan_lemasmil' => 'ruanganLemasmil.jenis_ruangan_lemasmil',
                'status_m_kiosk' => 'status_m_kiosk'
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
            $mKioskData = $query->get();

            $totalMKiosk = $mKioskData->count();
            $totalaktif = $mKioskData->where('status_m_kiosk', 'aktif')->count();
            $totalnonaktif = $mKioskData->where('status_m_kiosk', 'nonaktif')->count();

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = MkioskResource::collection($paginatedData);

            $responseData = [
                "status" => "OK",
                "message" => "Successfully get Data",
                "records" => $resourceCollection->toArray($request),
                "totalMKiosk" => $totalMKiosk,
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
    public function store(MkioskRequest $request)
    {
        try {
            if (Mkiosk::where('gmac', $request->gmac)->exists()) {
                return ApiResponse::error('Failed to create M Kiosk.', 'Gmac already exists.');
            }

            $mKiosk = new Mkiosk([
                'gmac' => $request->gmac,
                'nama_m_kiosk' => $request->nama_m_kiosk,
                'ruangan_otmil_id' => $request->ruangan_otmil_id,
                'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
                'status_m_kiosk' => $request->status_m_kiosk,
                'v_m_kiosk_topic' => $request->v_m_kiosk_topic
            ]);

            if ($mKiosk->save()) {
                $data = $mKiosk->toArray();
                $formattedData = array_merge(['id' => $mKiosk->id], $data);
                return ApiResponse::created($formattedData);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create M Kiosk.', $e->getMessage());
        }
    }

    public function update(MkioskRequest $request)
    {
        try {
            $id = $request->input('m_kiosk_id');
            $mKiosk = Mkiosk::findOrFail($id);
            $mKiosk->gmac = $request->gmac;
            $mKiosk->nama_m_kiosk = $request->nama_m_kiosk;
            $mKiosk->ruangan_otmil_id = $request->ruangan_otmil_id;
            $mKiosk->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $mKiosk->status_m_kiosk = $request->status_m_kiosk;
            $mKiosk->v_m_kiosk_topic = $request->v_m_kiosk_topic;

            if ($mKiosk->save()) {
                $data = $mKiosk->toArray();
                return ApiResponse::updated($data);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update M Kiosk.', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->input('m_kiosk_id');
            $mKiosk = Mkiosk::findOrFail($id);
            if (!$mKiosk) {
                return ApiResponse::error('M Kiosk not found.', 'M Kiosk not found.', 404);
            }
            $mKiosk->delete();
            return ApiResponse::deleted();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete M Kiosk.', $e->getMessage());
        }
    }

}
