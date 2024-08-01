<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\DesktopRequest;
use App\Http\Resources\DesktopResource;
use App\Models\Desktop;
use Exception;
use Illuminate\Http\Request;

class DesktopMapController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Desktop::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);
            $filterableColumns = [
                'lokasi_otmil_id' => 'ruanganOtmil.lokasiOtmil.lokasi_otmil_id',
                'lokasi_lemasmil_id' => 'ruanganLemasmil.lokasiLemasmil.lokasi_lemasmil_id',
                'ruangan_otmil_id' => 'ruangan_otmil_id',
                'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
                'gmac' => 'gmac',
                'nama_desktop' => 'nama_desktop',
                'model' => 'model',
                'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
                'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan_lemasmil',
                'jenis_ruangan_otmil' => 'ruanganOtmil.jenis_ruangan_otmil',
                'jenis_ruangan_lemasmil' => 'ruanganLemasmil.jenis_ruangan_lemasmil',
                'status_desktop' => 'status_desktop'
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

            $totalDesktop = $accessPointData->count();
            $totalaktif = $accessPointData->where('status_desktop', 'aktif')->count();
            $totalnonaktif = $accessPointData->where('status_desktop', 'nonaktif')->count();

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = DesktopResource::collection($paginatedData);

            $responseData = [
                "status" => "OK",
                "message" => "Successfully get Data",
                "records" => $resourceCollection->toArray($request),
                "totalDesktop" => $totalDesktop,
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

    public function store(DesktopRequest $request)
    {
        try {
            if (Desktop::where('gmac', $request->gmac)->exists()) {
                return ApiResponse::error('Failed to create Desktop.', 'Gmac already exists.');
            }

            $desktop = new Desktop([
                'gmac' => $request->gmac,
                'nama_desktop' => $request->nama_desktop,
                'model' => $request->model,
                'ruangan_otmil_id' => $request->ruangan_otmil_id,
                'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
                'status_desktop' => $request->status_desktop,
                'v_desktop_topic' => $request->v_desktop_topic
            ]);

            if ($desktop->save()) {
                $data = $desktop->toArray();
                $formattedData = array_merge(['id' => $desktop->id], $data);
                return ApiResponse::created($formattedData);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create Desktop.', $e->getMessage());
        }
    }

    public function update(DesktopRequest $request)
    {
        try {
            $id = $request->input('desktop_id');
            $desktop = Desktop::findOrFail($id);
            $desktop->gmac = $request->gmac;
            $desktop->model = $request->model;
            $desktop->nama_desktop = $request->nama_desktop;
            $desktop->ruangan_otmil_id = $request->ruangan_otmil_id;
            $desktop->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $desktop->status_desktop = $request->status_desktop;
            $desktop->v_desktop_topic = $request->v_desktop_topic;

            if ($desktop->save()) {
                $data = $desktop->toArray();
                return ApiResponse::updated($data);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update Desktop.', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->input('desktop_id');
            $desktop = Desktop::findOrFail($id);
            if (!$desktop) {
                return ApiResponse::error('Desktop not found.', 'Desktop not found.', 404);
            }
            $desktop->delete();
            return ApiResponse::deleted();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete Desktop.', $e->getMessage());
        }
    }
}
