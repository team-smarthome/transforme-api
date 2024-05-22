<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\TipeAset;
use Illuminate\Database\QueryException;
use Exception;
use App\Http\Requests\TipeAsetRequest;


class TipeAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            try {
                if (request('search')) {
                    $query = TipeAset::where('nama_tipe', 'like', '%' . request('search') . '%')->latest();
                } else {
                    $query = TipeAset::latest();
                }
    
                return ApiResponse::paginate($query);
    
            } catch (\Exception $e) {
                return ApiResponse::error('Failed to get Data.', $e->getMessage());
            }
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
    public function store(TipeAsetRequest $request)
    {
        try {
            $tipe_aset = TipeAset::create($request->validated());

            return ApiResponse::created($tipe_aset);
    
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
        $tipe_aset = TipeAset::findOrFail($id);

        return response()->json($tipe_aset, 200);
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
    public function update(TipeAsetRequest $request, string $id)
    {
        try {
            $tipe_aset = TipeAset::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Tipe Aset tidak ditemukan.', null, 404);
        }
    
        $namaEditTipeAset = $request->input('nama_tipe');
        $existingTipeAset = TipeAset::where('nama_tipe', $tipe_aset->nama_tipe)->first();
    
        if ($existingTipeAset && $existingTipeAset->id !== $id) {
            return ApiResponse::error('Nama Tipe Aset sudah ada.', null, 422);
        }
    
        $tipe_aset->update($request->all());
    
        return ApiResponse::updated($tipe_aset);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipe_aset = TipeAset::findOrFail($id);
        $tipe_aset->delete();

        return ApiResponse::deleted();
    }

    public function restore($id)
    {
        $tipe_aset = TipeAset::withTrashed()->findOrFail($id);
        $tipe_aset->restore();

        return response()->json($tipe_aset);
    }
}
