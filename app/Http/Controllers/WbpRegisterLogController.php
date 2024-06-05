<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\WbpRegisterLogResource;
use App\Models\WbpRegisterLog;
use Illuminate\Http\Request;

class WbpRegisterLogController extends Controller
{
    public function index()
    {
        $perPage = request()->input('per_page', 10);
        try {
            // Mempersiapkan query builder dengan eager loading
            $dataRegisterLogQuery = WbpRegisterLog::with([
                'wbpProfile.hunianWbpOtmil',
            ]);

            // Menghitung total data berdasarkan id
            $totalWbpRegister = $dataRegisterLogQuery->count();

            // Membuat query builder baru untuk menghitung total WBP masuk
            $totalWbpMasukQuery = WbpRegisterLog::where('keterangan', 'Masuk');
            $totalWbpMasuk = $totalWbpMasukQuery->count();

            // Membuat query builder baru untuk menghitung total WBP keluar
            $totalWbpKeluarQuery = WbpRegisterLog::where('keterangan', 'Keluar');
            $totalWbpKeluar = $totalWbpKeluarQuery->count();

            // Melakukan paginasi
            $paginatedData = $dataRegisterLogQuery->paginate($perPage);

            return ApiResponse::success([
                // 'total_wbp_register' => $totalWbpRegister,
                // 'total_wbp_masuk' => $totalWbpMasuk,
                // 'total_wbp_keluar' => $totalWbpKeluar,
                'records' => WbpRegisterLogResource::collection($paginatedData),
                'total_wbp_register' => $totalWbpRegister,
                'total_wbp_masuk' => $totalWbpMasuk,
                'total_wbp_keluar' => $totalWbpKeluar,
                'pagination' => [
                    'total' => $paginatedData->total(),
                    'per_page' => $paginatedData->perPage(),
                    'current_page' => $paginatedData->currentPage(),
                    'last_page' => $paginatedData->lastPage(),
                    'from' => $paginatedData->firstItem(),
                    'to' => $paginatedData->lastItem(),
                ]
            ]);
        } catch (\Throwable $th) {
            return ApiResponse::error('Failed to get data.', $th->getMessage());
        }
    }
}
