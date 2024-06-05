<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoriVonis;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiResponse;

class RekapVonisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $query = HistoriVonis::select(
                'histori_vonis.masa_tahanan_tahun',
                DB::raw('GROUP_CONCAT(wbp_profile.id) AS wbp_profile_id'),
                DB::raw('GROUP_CONCAT(kasus.id) AS kasus_id'),
                DB::raw('COUNT(wbp_profile.id) AS wbp_profile_count'),
                DB::raw('MIN(lokasi_otmil.nama_lokasi_otmil) AS nama_lokasi_otmil'),
                DB::raw('MIN(lokasi_lemasmil.nama_lokasi_lemasmil) AS nama_lokasi_lemasmil')
            )
            ->leftJoin('sidang', 'histori_vonis.sidang_id', '=', 'sidang.id')
            ->leftJoin('kasus', 'sidang.kasus_id', '=', 'kasus.id')
            ->leftJoin('wbp_profile', 'kasus.wbp_profile_id', '=', 'wbp_profile.id')
            ->leftJoin('hunian_wbp_otmil', 'wbp_profile.hunian_wbp_otmil_id', '=', 'hunian_wbp_otmil.id')
            ->leftJoin('hunian_wbp_lemasmil', 'wbp_profile.hunian_wbp_lemasmil_id', '=', 'hunian_wbp_lemasmil.id')
            ->leftJoin('lokasi_otmil', 'hunian_wbp_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
            ->leftJoin('lokasi_lemasmil', 'hunian_wbp_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
            ->groupBy('masa_tahanan_tahun');

            // Filter berdasarkan request
            $filterableColumns = [
                'nama_lokasi_otmil' => 'lokasi_otmil.nama_lokasi_otmil',
                'nama_lokasi_lemasmil' => 'lokasi_lemasmil.nama_lokasi_lemasmil',
                'masa_tahanan_tahun' => 'histori_vonis.masa_tahanan_tahun'
            ];

            foreach ($filterableColumns as $requestKey => $column) {
                if ($value = request($requestKey)) {
                    $query->where($column, 'like', '%' . $value . '%');
                }
            }

            // Order by masa_tahanan_tahun ASC
            $query->orderBy('masa_tahanan_tahun', 'ASC');

            // Tampilkan SQL yang dihasilkan
            // return $query->toSql();

            // // Kembalikan data dengan paginasi (opsional)
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
