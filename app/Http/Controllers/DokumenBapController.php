<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenBap;
use App\Http\Requests\DokumenBapRequest;
use App\Helpers\ApiResponse;
use App\Http\Resources\DokumenBapResource;

class DokumenBapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = DokumenBap::with(['penyidikan.kasus', 'wbpProfile.hunianWbpOtmil.lokasiOtmil', 'wbpProfile.hunianWbpLemasmil.lokasiLemasmil', 'saksi']);
            $filterableColumns = [
                'dokumen_bap_id' => 'id',
                'nama_dokumen_bap' => 'nama_dokumen_bap',
                'nomor_penyidikan' => 'penyidikan.nomor_penyidikan',
                'nomor_kasus' => 'penyidikan.kasus.nomor_kasus',
                'nrp_wbp' => 'wbpProfile.nrp',
                'nama' => 'wbpProfile.nama',
                'nama_saksi' => 'saksi.nama_saksi',
                'lokasi_otmil' => 'wbpProfile.hunianWbpOtmil.lokasiOtmil.nama_lokasi_otmil',
                'lokasi_lemasmil' => 'wbpProfile.hunianWbpLemasmil.lokasiLemasmil.nama_lokasi_lemasmil'
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    if ($requestKey === 'nomor_penyidikan') {
                        // Handle the relationship filter
                        $query->whereHas('penyidikan', function ($q) use ($filters, $requestKey) {
                            $q->where('nomor_penyidikan', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } else if ($requestKey === 'nomor_kasus') {
                        $query->whereHas('penyidikan.kasus', function($q) use($filters, $requestKey){
                            $q->where('nomor_kasus', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } else if($requestKey === 'nrp_wbp'){
                        $query->whereHas('wbpProfile', function($q) use($filters, $requestKey){
                            $q->where('nrp', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } else if($requestKey === 'nama'){
                        $query->whereHas('wbpProfile', function($q) use($filters, $requestKey){
                            $q->where('nama', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } else if($requestKey === 'nama_saksi'){
                        $query->whereHas('saksi', function($q) use($filters, $requestKey){
                            $q->where('nama_saksi', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } else if($requestKey === 'lokasi_otmil'){
                        $query->whereHas('wbpProfile.hunianWbpOtmil.lokasiOtmil', function($q) use($filters, $requestKey){
                            $q->where('nama_lokasi_otmil', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } else if($requestKey === 'lokasi_lemasmil'){
                        $query->whereHas('wbpProfile.hunianWbpLemasmil.lokasiLemasmil', function($q) use($filters, $requestKey){
                            $q->where('nama_lokasi_lemasmil', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } else {
                        $query->where($column, 'LIKE', '%' . $filters[$requestKey] . '%');
                    }
            }
        }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = DokumenBapResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
        } catch (\Exception $e) {
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
    public function store(DokumenBapRequest $request)
    {
        try {
            $dokumenBap = new DokumenBap([
                'penyidikan_id' => $request->penyidikan_id,
                'nama_dokumen_bap' => $request->nama_dokumen_bap,
                'wbp_profile_id' => $request->wbp_profile_id,
                'saksi_id' => $request->saksi_id
            ]);

            if ($request->hasFile('link_dokumen_bap')) {
                $dokumenPath = $request->file('link_dokumen_bap')->store('public/link_dokumen_bap_file');
                $dokumenBap->link_dokumen_bap = str_replace('public/', '', $dokumenPath);
            }

            $dokumenBap->save();
            return ApiResponse::created($dokumenBap);

        } catch (\Exception $e) {
            return ApiResponse::error('Failed to create Dokumen BAP.', $e->getMessage());
        }
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
    public function update(DokumenBapRequest $request)
    {
        try {
            $id = $request->input('dokumen_bap_id');
            $dokumenBap = DokumenBap::findOrFail($id);

            $dokumenBap->penyidikan_id = $request->penyidikan_id;
            $dokumenBap->nama_dokumen_bap = $request->nama_dokumen_bap;
            $dokumenBap->wbp_profile_id = $request->wbp_profile_id;
            $dokumenBap->saksi_id = $request->saksi_id;

            if ($request->hasFile('link_dokumen_bap')) {
                $dokumenPath = $request->file('link_dokumen_bap')->store('public/link_dokumen_bap_file');
                $dokumenBap->link_dokumen_bap = str_replace('public/', '', $dokumenPath);
            }

            $dokumenBap->save();
            return ApiResponse::updated($dokumenBap);

        } catch (\Exception $e) {
            return ApiResponse::error('Failed to update Dokumen BAP.', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('dokumen_bap_id');
            $dokumenBap = DokumenBap::findOrFail($id);
            if ($dokumenBap) {
                return ApiResponse::error('Dokumen BAP not found.', 404);
            }
            if ($dokumenBap->delete()) {
                return ApiResponse::deleted();
            }
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to delete Dokumen BAP.', $e-> getMessage(), 500);
        }
    }
}
