<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Resources\AktivitasGelangResource;
use App\Models\AktivitasGelang;

class AktivitasGelangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = AktivitasGelang::with(['wbpProfile']);
            $filterableColumns = [
                'aktivitas_gelang_id' => 'id',
                'wbp_profile_id' => 'wbp_profile_id',
                'nama_wbp' => 'wbpProfile.nama',
                'gelang_id' => 'wbpProfile.gelang_id',
                'nama_gelang' => 'wbpProfile.gelang.nama_gelang',
                'ruangan_otmil_id' => 'wbpProfile.gelang.ruangan_otmil_id',
                'nama_ruangan_otmil' => 'wbpProfile.gelang.ruanganOtmil.nama_ruangan_otmil',
                'lokasi_otmil_id' => 'wbpProfile.gelang.ruanganOtmil.lokasi_otmil_id',
                'nama_lokasi_otmil' => 'wbpProfile.gelang.ruanganOtmil.lokasiOtmil.nama_lokasi_otmil',
                'ruangan_lemasmil_id' => 'wbpProfile.gelang.ruangan_lemasmil_id',
                'nama_ruangan_lemasmil' => 'wbpProfile.gelang.ruanganLemasmil.nama_ruangan_lemasmil',
                'lokasi_lemasmil_id' => 'wbpProfile.gelang.ruanganLemasmil.lokasi_lemasmil_id',
                'nama_lokasi_lemasmil' => 'wbpProfile.gelang.ruanganLemasmil.lokasiLemasmil.nama_lokasi_lemasmil'
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    if($requestKey === 'nama_wbp'){
                        $query->whereHas('wbpProfile', function($q) use($filters, $requestKey){
                            $q->where('nama', 'LIKE', '%' . $filters[$requestKey] .'%');
                        });
                    } else if($requestKey === 'gelang_id'){
                        $query->whereHas('wbpProfile', function($q) use($filters, $requestKey){
                            $q->where('gelang_id', 'LIKE', '%' . $filters[$requestKey] .'%');
                        });
                    } else if($requestKey === 'nama_gelang'){
                        $query->whereHas('wbpProfile.gelang', function($q) use($filters, $requestKey){
                            $q->where('nama_gelang', 'LIKE', '%' . $filters[$requestKey] .'%');
                        });
                    } else if($requestKey === 'ruangan_otmil_id'){
                        $query->whereHas('wbpProfile.gelang', function($q) use($filters, $requestKey){
                            $q->where('ruangan_otmil_id', 'LIKE', '%' . $filters[$requestKey] .'%');
                        });
                    } else if($requestKey === 'nama_ruangan_otmil'){
                        $query->whereHas('wbpProfile.gelang.ruanganOtmil', function($q) use($filters, $requestKey){
                            $q->where('nama_ruangan_otmil', 'LIKE', '%' . $filters[$requestKey] .'%');
                        });
                    } else if($requestKey === 'lokasi_otmil_id'){
                        $query->whereHas('wbpProfile.gelang.ruanganOtmil', function($q) use($filters, $requestKey){
                            $q->where('lokasi_otmil_id', 'LIKE', '%' . $filters[$requestKey] .'%');
                        });
                    } else if($requestKey === 'nama_lokasi_otmil'){
                        $query->whereHas('wbpProfile.gelang.ruanganOtmil.lokasiOtmil', function($q) use($filters, $requestKey){
                            $q->where('nama_lokasi_otmil', 'LIKE', '%' . $filters[$requestKey] .'%');
                        });
                    } else if($requestKey === 'ruangan_lemasmil_id'){
                        $query->whereHas('wbpProfile.gelang', function($q) use($filters, $requestKey){
                            $q->where('ruangan_lemasmil_id', 'LIKE', '%' . $filters[$requestKey] .'%');
                        });
                    } else if($requestKey === 'nama_ruangan_lemasmil'){
                        $query->whereHas('wbpProfile.gelang.ruanganLemasmil', function($q) use($filters, $requestKey){
                            $q->where('nama_ruangan_lemasmil', 'LIKE', '%' . $filters[$requestKey] .'%');
                        });
                    } else if($requestKey === 'lokasi_lemasmil_id'){
                        $query->whereHas('wbpProfile.gelang.ruanganLemasmil', function($q) use($filters, $requestKey){
                            $q->where('lokasi_lemasmil_id', 'LIKE', '%' . $filters[$requestKey] .'%');
                        });
                    } else if($requestKey === 'nama_lokasi_lemasmil'){
                        $query->whereHas('wbpProfile.gelang.ruanganLemasmil.lokasiLemasmil', function($q) use($filters, $requestKey){
                            $q->where('nama_lokasi_lemasmil', 'LIKE', '%' . $filters[$requestKey] .'%');
                        });
                    }
                    else{
                        $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
                    }
                }
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = AktivitasGelangResource::collection($paginatedData);
            return ApiResponse::pagination($resourceCollection);

        } catch (\Exception $e) {
            return ApiResponse::error($e);
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
        $request->validate([
            'gmac' => 'required|string|max:255',
            'dmac'=> 'required|string|max:255',
            'baterai'=> 'required|string|max:255',
            'step'=> 'required|string|max:255',
            'heartrate'=> 'required|string|max:255',
            'temp'=> 'required|string|max:255',
            'spo'=> 'required|string|max:255',
            'systolic'=> 'required|string|max:255',
            'diastolic'=> 'required|string|max:255',
            'cutoff_flag'=> 'required|',
            'type'=> 'required|string|max:255',
            'x0'=> 'required|string|max:255',
            'y0'=> 'required|string|max:255',
            'z0'=> 'required|string|max:255',
            'wbp_profile_id'=> 'required|string|max:255',
            'rssi'=> 'required|string|max:255',
        ]);

        $aktivitasGelang = AktivitasGelang::create($request->all());

        return ApiResponse::success(['data'=> new AktivitasGelangResource($aktivitasGelang)]);
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
