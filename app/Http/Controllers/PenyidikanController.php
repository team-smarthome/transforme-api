<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyidikan;
use App\Http\Requests\PenyidikanRequest;
use App\Http\Resources\PenyidikanResource;
use App\Helpers\ApiResponse;
use Exception;

class PenyidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    try {
        $query = Penyidikan::with(['kasus', 'wbpProfile', 'saksi', 'oditurPenyidik']);
        $filterableColumns = [
            'penyidikan_id' => 'id',
            'nomor_penyidikan' => 'nomor_penyidikan',
            'agenda_penyidikan' => 'agenda_penyidikan',
            'dokumen_bap_id' => 'dokumen_bap_id',
            'wbp_profile_id' => 'wbp_profile_id',
            'saksi_id' => 'saksi_id',
            'oditur_penyidikan_id' => 'oditur_penyidikan_id',
            'zona_waktu' => 'zona_waktu'
        ];
        $filters = $request->input('filter', []);

        foreach ($filterableColumns as $requestKey => $column) {
            if (isset($filters[$requestKey])) {
                $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
            }
        }

        $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

        $query->latest();
        $resourceCollection = PenyidikanResource::collection($paginatedData);

        return ApiResponse::pagination($resourceCollection);
        // return ApiResponse::paginate($query);

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
    public function store(PenyidikanRequest $request)
    {
        try {
            $penyidikan =  new Penyidikan([
                'nomor_penyidikan' => $request->nomor_penyidikan,
                'kasus_id' => $request->kasus_id,
                'waktu_dimulai_penyidikan' => $request->waktu_dimulai_penyidikan,
                'agenda_penyidikan' => $request->agenda_penyidikan,
                'waktu_selesai_penyidikan' => $request->waktu_selesai_penyidikan,
                'dokumen_bap_id' => $request->dokumen_bap_id,
                'wbp_profile_id' => $request->wbp_profile_id,
                'saksi_id' => $request->saksi_id,
                'oditur_penyidikan_id' => $request->oditur_penyidikan_id,
                'zona_waktu' => $request->zona_waktu
            ]);

            if (Penyidikan::where('nomor_penyidikan', $request->nomor_penyidikan)->exists()) {
                return ApiResponse::error('Failed to create Penyidikan', 'Nomor Penyidikan already exists', 400);
            }

            if ($penyidikan->save()) {
                $data = $penyidikan->toArray();
                $formattedData = array_merge(['id' => $penyidikan->id], $data);
                return ApiResponse::created($formattedData);
            } else {
                return ApiResponse::error('Failed to create Data.', 'Failed to create Data.', 500);
            }

        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
    
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);

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
    public function update(PenyidikanRequest $request)
    {
        try {
            $id = $request->input('penyidikan_id');
            $penyidikan = Penyidikan::findOrfail($id);
            if (!$penyidikan) {
                return ApiResponse::error('Penyidikan not found', 'Penyidikan not found', 404);
            }

            $penyidikan->nomor_penyidikan = $request->nomor_penyidikan;
            $penyidikan->kasus_id = $request->kasus_id;
            $penyidikan->waktu_dimulai_penyidikan = $request->waktu_dimulai_penyidikan;
            $penyidikan->agenda_penyidikan = $request->agenda_penyidikan;
            $penyidikan->waktu_selesai_penyidikan = $request->waktu_selesai_penyidikan;
            $penyidikan->dokumen_bap_id = $request->dokumen_bap_id;
            $penyidikan->wbp_profile_id = $request->wbp_profile_id;
            $penyidikan->saksi_id = $request->saksi_id;
            $penyidikan->oditur_penyidikan_id = $request->oditur_penyidikan_id;
            $penyidikan->zona_waktu = $request->zona_waktu;

            if ($penyidikan->save()) {
                return ApiResponse::updated($penyidikan);
            } else {
                return ApiResponse::error('Failed to update Penyidikan', 'Unknown error', 500);
            }

        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
    
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('penyidikan_id');
            $penyidikan = Penyidikan::findOrfail($id);
            if (!$penyidikan) {
                return ApiResponse::error('Penyidikan not found', 'Penyidikan not found', 404);
            }

            if ($penyidikan->delete()) {
                return ApiResponse::deleted();
            } else {
                return ApiResponse::error('Failed to delete Penyidikan', 'Unknown error', 500);
            }

        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
    
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);

        }
    }
}