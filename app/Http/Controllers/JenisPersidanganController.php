<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\JenisPersidangan;
use Illuminate\Support\Facades\Validator;

class JenisPersidanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (request('search')) {
                $query = JenisPersidangan::where('nama_jenis_persidangan','like','%'. request('search') .'%')->latest();
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
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_jenis_persidangan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return ApiResponse::error('Validation error', $validator->errors(), 422);
        }

        try {
            // Simpan data ke database
            $jenisPersidangan = JenisPersidangan::create([
                'nama_jenis_persidangan' => $request->input('nama_jenis_persidangan'),
            ]);

            return ApiResponse::success('Data successfully created', $jenisPersidangan, 201);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to store data', $e->getMessage(), 500);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
