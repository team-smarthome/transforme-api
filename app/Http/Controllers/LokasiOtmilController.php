<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\LokasiOtmil;
use Illuminate\Database\QueryException;
use Exception;
use App\Http\Requests\LokasiOtmilRequest;

class LokasiOtmilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            try {
                if (request('search')) {
                    $query = LokasiOtmil::where('nama_lokasi_otmil', 'like', '%' . request('search') . '%')->latest();
                } else {
                    $query = LokasiOtmil::latest();
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
    public function store(LokasiOtmilRequest $request)
    {
        try {
            $lokasi_otmil = LokasiOtmil::create($request->validated());

            return ApiResponse::created($lokasi_otmil);
    
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
        $lokasi_lemasmil = LokasiLemasmil::findOrFail($id);

        return response()->json($lokasi_lemasmil, 200);
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
    public function update(LokasiOtmilRequest $request, string $id)
    {
        try {
            $lokasi_otmil = LokasiOtmil::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Lokasi Otmil tidak ditemukan.', null, 404);
        }
    
        $namaEditLokasiOtmil = $request->input('nama_lokasi_otmil');
        $existingLokasiOtmil = LokasiOtmil::where('nama_lokasi_otmil', $namaEditLokasiOtmil)->first();
    
        if ($existingLokasiOtmil && $existingLokasiOtmil->id !== $id) {
            return ApiResponse::error('Nama Lokasi Otmil sudah ada.', null, 422);
        }
    
        $updatedData = array_merge($lokasi_otmil->toArray(), $request->all());
    
        $lokasi_otmil->update($updatedData);
    
        return ApiResponse::updated($lokasi_otmil);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lokasi_otmil = LokasiOtmil::findOrFail($id);
        $lokasi_otmil->delete();

        return ApiResponse::deleted();
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        $lokasi_otmil = LokasiOtmil::withTrashed()->findOrFail($id);
        $lokasi_otmil->restore();

        return ApiResponse::restored();
    }
}
