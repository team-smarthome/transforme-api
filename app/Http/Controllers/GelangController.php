<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gelang;
use App\Helpers\ApiResponse;
use App\Http\Requests\GelangRequest;
use App\Http\Resources\DashboardGelangResource;
use App\Http\Resources\GelangResource;
use App\Models\WbpProfile;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class GelangController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Gelang::query();
            $filterableColumns = [
                'gelang_id' => 'id',
                'dmac' => 'dmac',
                'nama_gelang' => 'nama_gelang',
                'tanggal_pasang' => 'tanggal_pasang',
                'tanggal_aktivasi' => 'tanggal_aktivasi',
                'ruangan_otmil_id' => 'ruangan_otmil_id',
                'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
                'nama_ruangan_lemasmil' => 'nama_ruangan_lemasmil',
                'baterai' => 'baterai'
            ];
            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
                }
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = GelangResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get data.', $e->getMessage());
        }
    }

    public function dashboardGelang(Request $request)
    {
        try {
            $query = Gelang::with('ruanganOtmil.lokasiOtmil', 'ruanganOtmil.zona', 'ruanganLemasmil.lokasiLemasmil', 'ruanganLemasmil.zona', 'gelangWbp');
            $filterableColumns = [
                'gelang_id' => 'id',
                'dmac' => 'dmac',
                'nama_gelang' => 'nama_gelang',
                'tanggal_pasang' => 'tanggal_pasang',
                'tanggal_aktivasi' => 'tanggal_aktivasi',
                'ruangan_otmil_id' => 'ruangan_otmil_id',
                'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
                'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
                'nama_ruangan_lemasmmil' => 'ruanganLemasmil.nama_ruangan_lemasmmil',
                'baterai' => 'baterai',
                'lokasi_otmil_id' => 'ruanganOtmil.lokasi_otmil_id',
                'nama_lokasi_otmil' => 'ruanganOtmil.lokasiOtmil.nama_lokasi_otmil',
                'nama_wbp' => 'gelangWbp.nama'
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $key => $column) {
                if (isset($filters[$key])) {
                    if ($key === 'nama_ruangan_otmil') {
                        $query->whereHas('ruanganOtmil', function ($q) use ($filters, $key) {
                            $q->where('nama_ruangan_otmil', 'LIKE', '%' . $filters[$key] . '%');
                        });
                    } elseif ($key === 'nama_ruangan_lemasmmil') {
                        $query->whereHas('ruanganLemasmil', function ($q) use ($filters, $key) {
                            $q->where('nama_ruangan_lemasmmil', 'LIKE', '%' . $filters[$key] . '%');
                        });
                    } elseif ($key === 'lokasi_otmil_id') {
                        $query->whereHas('ruanganOtmil', function ($q) use ($filters, $key) {
                            $q->where('lokasi_otmil_id', 'LIKE', '%' . $filters[$key] . '%');
                        });
                    } elseif ($key === 'lokasi_lemasmil_id') {
                        $query->whereHas('ruanganLemasmil', function ($q) use ($filters, $key) {
                            $q->where('lokasi_lemasmil_id', 'LIKE', '%' . $filters[$key] . '%');
                        });
                    } elseif ($key === 'nama_lokasi_otmil') {
                        $query->whereHas('ruanganOtmil.lokasiOtmil', function ($q) use ($filters, $key) {
                            $q->where('nama_lokasi_otmil', 'LIKE', '%' . $filters[$key] . '%');
                        });
                    } elseif ($key === 'nama_lokasi_lemasmil') {
                        $query->whereHas('ruanganLemasmil.lokasiLemasmil', function ($q) use ($filters, $key) {
                            $q->where('nama_lokasi_lemasmil', 'LIKE', '%' . $filters[$key] . '%');
                        });
                    } elseif ($key === 'nama_wbp') {
                        $query->whereHas('gelangWbp', function ($q) use ($filters, $key) {
                            $q->where('nama', 'LIKE', '%' . $filters[$key] . '%');
                        });
                    } else {
                        $query->where($column, 'LIKE', '%' . $filters[$key] . '%');
                    }
                }
            }

            $query->latest();
            $gelangData = $query->get();

            $totalGelang = $gelangData->count();
            $gelangLow = $gelangData->where('baterai', '<', 25)->count();
            $gelangAktif = $gelangData->where('baterai', '>=', 25)->count();
            
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = DashboardGelangResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
            // return ApiResponse::success([
            //     'total_gelang' => $totalGelang,
            //     'gelang_low' => $gelangLow,
            //     'gelang_aktif' => $gelangAktif,
            //     'gelang_data' => $resourceCollection,
            // ], 'Successfully get Data');
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get data.', $e->getMessage());
        }
    }

    public function store(GelangRequest $request)
    {
        try {
            $gelang = Gelang::create($request->validated());

            return ApiResponse::created($gelang);
        } catch (QueryException $e) {
            // Menangani kesalahan query database, seperti pelanggaran constraint unik
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception $e) {
            // Menangani semua kesalahan lain yang tidak terduga
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $gelang_id = $request->input('gelang_id');
            $gelang = Gelang::findOrFail($gelang_id);

            $existingGelang = Gelang::where('nama_gelang', $gelang->nama_gelang)->first();

            if ($existingGelang && $existingGelang->id !== $gelang_id) {
                return ApiResponse::error('Gelang sudah ada', 500);
            }
            $gelang->update($request->all());
            return ApiResponse::updated($gelang);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Gelang not found', 404);
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $gelang_id = $request->input('gelang_id');
            $gelang = Gelang::findOrFail($gelang_id);
            $gelang->delete();
            return ApiResponse::deleted();
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
    }
}
