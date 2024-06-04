<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WbpProfile;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiResponse;


class RekapWbpDiperbantukan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $query = WbpProfile::selectRaw('
            GROUP_CONCAT(wbp_profile.id) AS wbp_profile_id,
            GROUP_CONCAT(wbp_profile.nama) AS nama,
            GROUP_CONCAT(lokasi_otmil.nama_lokasi_otmil) AS lokasi_otmil,
            GROUP_CONCAT(lokasi_lemasmil.nama_lokasi_lemasmil) AS lokasi_lemasmil,
            COUNT(wbp_profile.nama) as total_diperbantukan
        ')
        ->leftJoin('hunian_wbp_otmil', 'wbp_profile.hunian_wbp_otmil_id', '=', 'hunian_wbp_otmil.id')
        ->leftJoin('hunian_wbp_lemasmil', 'wbp_profile.hunian_wbp_lemasmil_id', '=', 'hunian_wbp_lemasmil.id')
        ->leftJoin('lokasi_otmil', 'hunian_wbp_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
        ->leftJoin('lokasi_lemasmil', 'hunian_wbp_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
        ->where('wbp_profile.deleted_at', null)
        ->where('wbp_profile.is_diperbantukan', 1);
            
            // Filter berdasarkan request
            $filterableColumns = [
                'nama_lokasi_otmil' => 'lokasi_otmil.nama_lokasi_otmil',
                'nama_lokasi_lemasmil' => 'lokasi_lemasmil.nama_lokasi_lemasmil',
                'wbp_profile_id' => 'wbp_profile.wbp_profile_id'
            ];

            foreach ($filterableColumns as $requestKey => $column) {
                if ($value = request($requestKey)) {
                    $query->where($column, 'like', '%' . $value . '%');
                }
            }

            // $query->latest();

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
