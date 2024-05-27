<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Requests\JenisPersidanganRequest;
use App\Models\JenisPersidangan;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class JenisPersidanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if (request('search')) {
                $keyword = $request->input('search');
                $query = JenisPersidangan::where('nama_jenis_persidangan','like','%'. $keyword .'%')->latest();
            } else {
                $query = JenisPersidangan::latest();
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
    public function store(JenisPersidanganRequest $request)
    {
        try {
            // Simpan data ke database
            $jenisPersidangan = JenisPersidangan::create($request->validated());

            return ApiResponse::created($jenisPersidangan);
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
        $jenisPersidangan = JenisPersidangan::findOrFail($id);
        return response()->json($jenisPersidangan, 200);
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
    public function update(JenisPersidanganRequest $request, string $id)
    {
        $request->validate(['nama_jenis_persidangan' => 'required|string|max:255',]);

        $jenisPersidangan = JenisPersidangan::findOrFail($id);

        $existingJenisPersidangan = JenisPersidangan::where('nama_jenis_persidangan', $jenisPersidangan->id)->first();

        if ($existingJenisPersidangan && $existingJenisPersidangan->id !== $id) {
            return ApiResponse::error('Nama jenis persidangan sudah ada.', null, 422);
        }

        $jenisPersidangan->update($request->all());

        return ApiResponse::updated($jenisPersidangan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisPersidangan = JenisPersidangan::findOrFail($id);
        $jenisPersidangan->delete();

        return ApiResponse::deleted();
    }

    public function restore($id){
        $jenisPersidangan = JenisPersidangan::withTrashed()->findOrFail($id);
        $jenisPersidangan->restore();

        return response()->json($jenisPersidangan);
    }
}
