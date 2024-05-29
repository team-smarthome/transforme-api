<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\LokasiLemasmil;
use Illuminate\Database\QueryException;
use Exception;
use App\Http\Requests\LokasiLemasmilRequest;


class LokasiLemasmilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (request('lokasi_lemasmil_id')) {
                $query = LokasiLemasmil::where('id', request('lokasi_lemasmil_id'));
                if (request('nama_lokasi_lemasmil') && $query->exists()) {
                    $query = LokasiLemasmil::where('nama_lokasi_lemasmil', 'like', '%' . request('nama_lokasi_lemasmil') . '%');
                } 
            } elseif(request('nama_lokasi_lemasmil')) {
                $query = LokasiLemasmil::where('nama_lokasi_lemasmil', 'like', '%' . request('nama_lokasi_lemasmil') . '%')->latest();
            } else {
                $query = LokasiLemasmil::latest();
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
    public function store(LokasiLemasmilRequest $request)
    {
        try {
            $lokasi_lemasmil = LokasiLemasmil::create($request->validated());
            $data = $lokasi_lemasmil->toArray();
            $formattedData = array_merge(['id' => $lokasi_lemasmil->id], $data);
            return ApiResponse::created($formattedData);
    
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
    public function update(LokasiLemasmilRequest $request)
    {
        try {
            $id = $request->input('lokasi_lemasmil_id');
            $lokasi_lemasmil = LokasiLemasmil::findOrFail($id);
            $lokasi_lemasmil->update($request->validated());

        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);

        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }

        return ApiResponse::updated($lokasi_lemasmil);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('lokasi_lemasmil_id');
            $lokasi_lemasmil = LokasiLemasmil::findOrFail($id);
            $lokasi_lemasmil->delete();

        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error('Data has Already delete', $e->getMessage(), 500);
        }
        return ApiResponse::deleted(); 
    }

    public function restore($id)
    {
        $lokasi_lemasmil = LokasiLemasmil::withTrashed()->findOrFail($id);
        $lokasi_lemasmil->restore();

        return response()->json($lokasi_lemasmil);
    }
}
