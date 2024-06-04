<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use Exception;
use App\Models\PenilaianKegiatanWbp;
use Illuminate\Support\Facades\DB;

class PenilaianKegiatanWbpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $query = PenilaianKegiatanWbp::with([
                'wbpProfile',
                'wbpProfile.hunianWbpOtmil.lokasiOtmil',
                'wbpProfile.hunianWbpLemasMil.lokasiLemasMil',
                'kegiatan'
            ])
            ->where('absensi', 'like', 'hadir')
            ->whereNull('deleted_at');
            $filterableColumns = [
                'nama' => 'wbp_profile.nama',
                'nrp' => 'wbp_profile.nrp',
                'nama_kegiatan' => 'kegiatan.nama_kegiatan',
                'lokasi_otmil' => 'lokasi_otmil.nama_lokasi_otmil',
                'lokasi_lemasmil' => 'lokasi_lemasmil.nama_lokasi_lemasmil',
            ];

            foreach ($filterableColumns as $requestKey => $column) {
                if ($value = request($requestKey)) {
                    $query->where($column, 'like', '%' . $value . '%');
                }
            }
            $query = $query->orderBy('created_at', 'desc');
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
