<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Requests\JenisPersidanganRequest;
use App\Http\Resources\JenisPersidanganResource;
use App\Models\JenisPersidangan;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Exception;

class JenisPersidanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = JenisPersidangan::query();
            $filterableColumns = [
                'nama_jenis_persidangan' => 'nama_jenis_persidangan'
            ];

            foreach ($filterableColumns as $requestKey => $column) {
                if ($request->has($requestKey)) {
                    $query->where($column, 'like', '%' . $request->input($requestKey) . '%');
                }
            }

            $query->latest();
            $paginateData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = JenisPersidanganResource::collection($paginateData);

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
    public function show(Request $request)
    {
        $id = $request->input('id');
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
    public function update(JenisPersidanganRequest $request)
    {
        $id = $request->input('jenis_persidangan_id');
        $jenis_persidangan = JenisPersidangan::findOrFail($id);

        $namaEditingJenisPersidangan = $request->input('nama_jenis_persidangan');
        $existingJenisPersidangan = JenisPersidangan::where('nama_jenis_persidangan', $jenis_persidangan->nama_jenis_persidangan)->first();

        if ($existingJenisPersidangan && $existingJenisPersidangan->id !== $id) {
            return ApiResponse::error('Nama jenis persidangan sudah ada.', null, 422);
        }

        $jenis_persidangan->update($request->all());

        return ApiResponse::updated($jenis_persidangan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('jenis_persidangan_id');
        $jenisPersidangan = JenisPersidangan::findOrFail($id);
        $jenisPersidangan->delete();

        return ApiResponse::deleted();
    }

    public function restore($id)
    {
        $jenisPersidangan = JenisPersidangan::withTrashed()->findOrFail($id);
        $jenisPersidangan->restore();

        return response()->json($jenisPersidangan);
    }
}
