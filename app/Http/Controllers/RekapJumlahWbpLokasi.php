<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use Exception;
use App\Models\WbpProfile;
use Illuminate\Support\Facades\DB;



class RekapJumlahWbpLokasi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $query = WbpProfile::select(
                'lokasi_otmil.nama_lokasi_otmil AS lokasi_otmil',
                'lokasi_lemasmil.nama_lokasi_lemasmil AS lokasi_lemasmil',
                DB::raw('COUNT(wbp_profile.id) AS total_wbp'),
                DB::raw('GROUP_CONCAT(wbp_profile.nama) AS nama_wbp'),
                DB::raw('SUM(CASE WHEN matra.nama_matra = "TNI Angkatan Darat" THEN 1 ELSE 0 END) AS total_angkatan_darat'),
                DB::raw('SUM(CASE WHEN matra.nama_matra = "TNI Angkatan Laut" THEN 1 ELSE 0 END) AS total_angkatan_laut'),
                DB::raw('SUM(CASE WHEN matra.nama_matra = "TNI Angkatan Udara" THEN 1 ELSE 0 END) AS total_angkatan_udara')
            )
            ->leftJoin('hunian_wbp_otmil', 'wbp_profile.hunian_wbp_otmil_id', '=', 'hunian_wbp_otmil.id')
            ->leftJoin('lokasi_otmil', 'hunian_wbp_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
            ->leftJoin('hunian_wbp_lemasmil', 'wbp_profile.hunian_wbp_lemasmil_id', '=', 'hunian_wbp_lemasmil.id')
            ->leftJoin('lokasi_lemasmil', 'hunian_wbp_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
            ->leftJoin('matra', 'wbp_profile.matra_id', '=', 'matra.id')
            ->groupBy('lokasi_otmil.nama_lokasi_otmil', 'lokasi_lemasmil.nama_lokasi_lemasmil');
                
            $filterableColumns = [
                'lokasi_otmil' => 'lokasi_otmil.nama_lokasi_otmil',
                'lokasi_lemasmil' => 'lokasi_lemasmil.nama_lokasi_lemasmil',
                'nama_wbp' => 'wbp_profile.nama'
            ];

            foreach ($filterableColumns as $requestKey => $column) {
                if ($value = request($requestKey)) {
                    $query->where($column, 'like', '%' . $value . '%');
                }
            }
            return ApiResponse::paginate($query);
                
        } catch (Exception $e) {
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
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
