<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\OditurPenuntut;
use Illuminate\Database\QueryException;
use Exception;
use App\Http\Requests\OditurPenuntutRequest;

class OditurPenuntutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
            try {
                if(request('id')) {
                    $query = OditurPenuntut::where('id', request('oditur_penuntut_id'));
                    if (request('nip') && $query->exists()) {
                        $query = OditurPenuntut::where('nip', 'like', '%' . request('nip') . '%');
                        if (request('nama_oditur') && $query->exists()) {
                            $query->where('nama_oditur', 'like', '%' . request('nama_oditur') . '%');
                        }  
                    }  
                } elseif (request('nip')) {
                    $query = OditurPenuntut::where('nip', 'like', '%' . request('nip') . '%');
                    if (request('nama_oditur') && $query->exists()) {
                        $query->where('nama_oditur', 'like', '%' . request('nama_oditur') . '%');
                    }  
                }  elseif(request('nama_oditur')) {
                    $query = OditurPenuntut::where('nama_oditur', 'like', '%' . request('nama_oditur') . '%')->latest();
                } else {
                    $query = OditurPenuntut::latest();
                }
    
                return ApiResponse::paginate($query);
    
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
    public function store(OditurPenuntutRequest $request)
    {
        try {
            if (OditurPenuntut::where('nip', $request->nip)->exists()) {
                return ApiResponse::error('Data already exists', 'Data with NIP ' . $request->nip . ' already exists', 400);
            }

            $oditur_penuntut = OditurPenuntut::create($request->validated());
            return ApiResponse::created($oditur_penuntut);
    
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
        $oditur_penuntut = OditurPenuntut::findOrFail($id);

        return response()->json($oditur_penuntut, 200);
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
    public function update(OditurPenuntutRequest $request)
    {
        try {
            $id = $request->input('id');
            $oditur_penuntut = OditurPenuntut::findOrFail($id);
            $nipEditOditurPenuntut = $request->input('nip');
            $existingOditurPenuntut = OditurPenuntut::where('nip', $nipEditOditurPenuntut)->exists();
            if ($existingOditurPenuntut) {
                return ApiResponse::error('nip has already been taken.', null, 422);
            }
            $oditur_penuntut->update($request->all());
            
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
        
        return ApiResponse::updated($oditur_penuntut);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $id = $request->input('id');
            $oditur_penuntut = OditurPenuntut::findOrFail($id);
            $oditur_penuntut->delete();

        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error('Data has Already delete', $e->getMessage(), 500);
        }
        return ApiResponse::deleted();
    }

    public function restore($id)
    {
        $oditur_penuntut = OditurPenuntut::withTrashed()->findOrFail($id);
        $oditur_penuntut->restore();

        return response()->json($oditur_penuntut);
    }
    
}
