<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\OditurPenyidik;
use Illuminate\Database\QueryException;
use Exception;
use App\Http\Requests\OditurPenyidikRequest;
use App\Http\Resources\OditurPenyidikResource;

class OditurPenyidikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            try {
                // if (request('oditur_penyidik_id')) {
                //     $query = OditurPenyidik::where('id', request('oditur_penyidik_id'));
                //     if (request('nip') && $query->exists()) {
                //         $query = OditurPenyidik::where('nip', 'like', '%' . request('nip') . '%');
                //         if (request('nama_oditur') && $query->exists()) {
                //             $query->where('nama_oditur', 'like', '%' . request('nama_oditur') . '%');
                //         }  
                //     }  
                // } elseif (request('nip')) {
                //     $query = OditurPenyidik::where('nip', 'like', '%' . request('nip') . '%');
                //     if (request('nama_oditur') && $query->exists()) {
                //         $query->where('nama_oditur', 'like', '%' . request('nama_oditur') . '%');
                //     }  
                // }  elseif(request('nama_oditur')) {
                //     $query = OditurPenyidik::where('nama_oditur', 'like', '%' . request('nama_oditur') . '%')->latest();
                // } else {
                //     $query = OditurPenyidik::latest();
                // }
    
                // return ApiResponse::paginate($query);
                $query = OditurPenyidik::query();
                $filterableColumn = [
                    'oditur_penyidik_id' => 'id',
                    'nip' => 'nip',
                    'nama_oditur' => 'nama_oditur',
                    'alamat' => 'alamat'
                ];

                $filters = $request->input('filter', []);

                foreach ($filterableColumn as $requestKey => $column) {
                    if (isset( $filters[$requestKey ])) {
                        $query->where($column, 'like', '%' . $filters[$requestKey] .'%');
                    }
                }

                $query->latest();
                $paginateData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

                $resourceCollection = OditurPenyidikResource::collection($paginateData);

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

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OditurPenyidikRequest $request)
    {
        try {
            if (OditurPenyidik::where('nip', $request->nip)->exists()) {
                return ApiResponse::error('Data already exists', 'Data with NIP ' . $request->nip . ' already exists', 400);
            }

            $oditur_penyidik = OditurPenyidik::create($request->validated());
            return ApiResponse::created($oditur_penyidik);
    
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
        $oditur_penyidik = OditurPenyidik::findOrFail($id);

        return response()->json($oditur_penyidik, 200);
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
    public function update(OditurPenyidikRequest $request)
    {
        try {
            $id = $request->input('oditur_penyidik_id');
            $oditur_penyidik = OditurPenyidik::findOrFail($id);
            $nipEditOditurPenyidik = $request->input('nip');
            $existingOditurPenyidik = OditurPenyidik::where('nip', $nipEditOditurPenyidik)->exists();
            if ($existingOditurPenyidik) {
                return ApiResponse::error('nip has already been taken.', null, 422);
            }
            $oditur_penyidik->update($request->all());
            
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
        
        return ApiResponse::updated($oditur_penyidik);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('oditur_penyidik_id');
            $oditur_penyidik = OditurPenyidik::findOrFail($id);
            $oditur_penyidik->delete();

        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error('Data has Already delete', $e->getMessage(), 500);
        }
        return ApiResponse::deleted();
    }
    

    public function restore($id)
    {
        $oditur_penyidik = OditurPenyidik::withTrashed()->findOrFail($id);
        $oditur_penyidik->restore();

        return response()->json($oditur_penyidik);
    }
}
