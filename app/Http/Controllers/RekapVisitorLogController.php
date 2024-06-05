<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiResponse;

class RekapVisitorLogController extends Controller
{
    public function index(Request $request)
    {
        try {
            $tahun = $request->input('tahun');
            $query = Pengunjung::selectRaw('
            DATE_FORMAT(pengunjung.created_at, "%Y-%m") AS bulan,
            lokasi_otmil.nama_lokasi_otmil,
            lokasi_lemasmil.nama_lokasi_lemasmil,
            COUNT(pengunjung.id) AS total_pengunjung,
            COUNT(pengunjung.foto_wajah_fr) AS total_pengunjung_foto_wajah_fr
        ')
        ->leftJoin('wbp_profile', 'pengunjung.wbp_profile_id', '=', 'wbp_profile.id')
        ->leftJoin('hunian_wbp_otmil', 'wbp_profile.hunian_wbp_otmil_id', '=', 'hunian_wbp_otmil.id')
        ->leftJoin('hunian_wbp_lemasmil', 'wbp_profile.hunian_wbp_lemasmil_id', '=', 'hunian_wbp_lemasmil.id')
        ->leftJoin('lokasi_otmil', 'hunian_wbp_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
        ->leftJoin('lokasi_lemasmil', 'hunian_wbp_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
        ->whereYear('pengunjung.created_at', $tahun)
        ->groupBy('bulan', 'lokasi_otmil.nama_lokasi_otmil', 'lokasi_lemasmil.nama_lokasi_lemasmil');

            $filterableColumns = [
                'bulan' => 'DATE_FORMAT(pengunjung.created_at, "%Y-%m")',
                'nama_lokasi_otmil' => 'lokasi_otmil.nama_lokasi_otmil',
                'nama_lokasi_lemasmil' => 'lokasi_lemasmil.nama_lokasi_lemasmil'
            ];

            foreach ($filterableColumns as $requestKey => $column) {
                if ($value = request($requestKey)) {
                    $query->where($column, 'like', '%' . $value . '%');
                }
            }

            $query->orderBy('bulan', 'ASC');

            return ApiResponse::paginate($query);

        } catch (Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        }
    }
}
