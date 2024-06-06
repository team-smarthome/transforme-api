<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bap;
use App\Http\Requests\BapRequest;
use App\Helpers\ApiResponse;
use Exception;

class BapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        try {
            $query = Bap::with(['penyidikan', 'dokumenBap']);
            $filterableColumns = [
                'bap_id' => 'id',
                'penyidikan_id' => 'penyidikan_id',
                'dokumen_bap_id' => 'dokumen_bap_id',
            ];
            foreach ($filterableColumns as $requestKey => $column) {
                if ($value = request($requestKey)) {
                    $query->where($column, 'like', '%' . $value . '%');
                }
            }

            $query->latest();
            return ApiResponse::paginate($query);


            // if (request('bap_id')) {
            //     $query = Bap::with(["penyidikan", "dokumenBap"])
            //         ->where('id', request('bap_id'));
            //     if (request('penyidikan_id') && $query->exists()) {
            //         $query->where('penyidikan_id', 'like', '%' . request('penyidikan_id') . '%');
            //         if (request('dokumen_bap_id') && $query->exists()) {
            //             $query->where('dokumen_bap_id', 'like', '%' . request('dokumen_bap_id') . '%');
            //         }      
            //     }
            // } elseif(request('penyidikan_id')) {
            //     $query = Bap::with(["penyidikan", "dokumenBap"])
            //         ->where('penyidikan_id', 'like', '%' . request('penyidikan_id') . '%')->latest();
            //     if (request('dokumen_bap_id') && $query->exists()) {
            //         $query->where('dokumen_bap_id', 'like', '%' . request('dokumen_bap_id') . '%');
            //     }
            // } elseif(request('dokumen_bap_id')) {
            //     $query = Bap::with(["penyidikan", "dokumenBap"])
            //         ->where('dokumen_bap_id', 'like', '%' . request('dokumen_bap_id') . '%')->latest();
            // } else {
            //     $query = Bap::with(["penyidikan", "dokumenBap"])->latest();
            // }

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
    public function store(BapRequest $request)
    {
        try {
            $bap =  new Bap([
                'penyidikan_id' => $request->penyidikan_id,
                'dokumen_bap_id' => $request->dokumen_bap_id,
            ]);
            if ($bap->save()) {
                $data = $bap->toArray();
                $formattedData = array_merge(['id' => $bap->id], $data);
                return ApiResponse::created($formattedData);
            } else {
                    return ApiResponse::error('Failed to create Data.', 'Failed to create Data.', 500);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create BAP.', $e->getMessage());
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
    public function update(BapRequest $request)
    {
        try {
            $id = $request->input('bap_id');
            $bap = Bap::find($id);
            if (!$bap) {
                return ApiResponse::notFound('BAP not found.');
            }
            $bap->penyidikan_id = $request->penyidikan_id;
            $bap->dokumen_bap_id = $request->dokumen_bap_id;
            if ($bap->save()) {
                return ApiResponse::updated($bap);
            } else {
                return ApiResponse::error('Failed to update BAP.', 'Failed to update BAP.', 500);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update BAP.', $e->getMessage());
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
            $id = $request->input('bap_id');
            $bap = Bap::find($id);
            if (!$bap) {
                return ApiResponse::notFound('BAP not found.');
            }
            if ($bap->delete()) {
                return ApiResponse::deleted();
            } else {
                return ApiResponse::error('Failed to delete BAP.', 'Failed to delete BAP.', 500);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete BAP.', $e->getMessage());
        }
    }
}
