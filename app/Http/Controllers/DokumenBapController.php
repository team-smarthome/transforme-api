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
            $query = DokumenBap::with(['penyidikan', 'wbpProfile', 'saksi'   ]);
            $filterableColumns = [
                'dokumen_bap_id' => 'id',
                'nama_dokumen_bap' => 'nama_dokumen_bap',
                'link_dokumen_bap' => 'link_dokumen_bap',
                'penyidikan_id' => 'penyidikan_id',
                'wbp_profile_id' => 'wbp_profile_id',
                'saksi_id' => 'saksi_id',
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                // if ($value = request($requestKey)) {
                //     $query->where($column, 'like', '%' . $value . '%');
                // }

                if (isset($filters[$requestKey])) {
                    $query->where($column, 'like', '%' . $filters[$requestKey] .'%');
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
