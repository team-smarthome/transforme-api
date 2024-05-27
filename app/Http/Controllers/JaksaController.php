<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Requests\JaksaRequest;
use App\Models\Jaksa;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Exception;

class JaksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if (request('search')) {
                $keyword = $request->input('search');
                $query = Jaksa::where('nama_jaksa','like','%'. $keyword .'%')->latest();
            } else {
                $query = Jaksa::latest();
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
    public function store(JaksaRequest $request)
    {
        try {
            $jaksa = Jaksa::create($request->validated());
            return ApiResponse::created($jaksa);
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
        $jaksa = Jaksa::findOrFail($id);
        return response()->json($jaksa, 200);
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
    public function update(JaksaRequest $request, string $id)
    {
        $request->validate([
            'nrp_jaksa' => 'required|string|max:100',
            'nama_jaksa' => 'required|string|max:100',
            'alamat' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'spesialisasi_hukum' => 'required|string|max:100',
            'divisi' => 'required|string|max:100',
            'tanggal_pensiun' => 'required|string|max:100'
        ]);

        $jaksa = Jaksa::findOrFail($id);

        $existingJaksa = Jaksa::where('nama_jaksa', $jaksa->nama_jaksa)->first();

        if ($existingJaksa && $existingJaksa->id !== $id) {
            return ApiResponse::error('Nama jaksa sudah ada.', null, 422);
        }

        $jaksa->update($request->all());
        return ApiResponse::updated($jaksa);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jaksa = Jaksa::findOrFail($id);
        $jaksa->delete();

        return ApiResponse::deleted();
    }

    public function restore($id){
        $jaksa = Jaksa::withTrashed()->findOrFail($id);
        $jaksa->restore();

        return response()->json($jaksa);
    }
}
