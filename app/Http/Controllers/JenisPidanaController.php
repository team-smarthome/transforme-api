<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\JenisPidana;
use Illuminate\Http\Request;
use App\Http\Requests\JenisPidanaRequest;
use Illuminate\Database\QueryException;
use Spatie\FlareClient\Api;

class JenisPidanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if (request('search')) {
                $keyword = $request->input('search');
                $query = JenisPidana::where('nama_jenis_pidana','LIKE','%'. $keyword .'%')->latest();
            } else {
                $query = JenisPidana::latest();
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
    public function store(JenisPidanaRequest $request)
    {
        try {
            $jenisPidana = JenisPidana::create($request->validated());

            return ApiResponse::created($jenisPidana);
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (\Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jenisPidana = JenisPidana::findOrFail($id);

        return response()->json($jenisPidana, 200);
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
    public function update(JenisPidanaRequest $request, string $id)
    {
        $request->validate(['nama_jenis_pidana' => 'required|string|max:255']);

        $jenisPidana = JenisPidana::findOrFail($id);

        $existingJenisPidana = JenisPidana::where('nama_jenis_pidana', $jenisPidana->nama_jenis_pidana)->first();

        if ($existingJenisPidana && $existingJenisPidana->id !== $id) {
            return ApiResponse::error('Nama jenis pidana sudah ada.', null, 422);
        }

        $jenisPidana->update($request->all());
        return ApiResponse::updated($jenisPidana);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisPidana = JenisPidana::findOrFail($id);
        $jenisPidana->delete();

        return ApiResponse::deleted();
    }

    public function restore($id){
        $jenisPidana = JenisPidana::withTrashed()->findOrFail($id);
        $jenisPidana->restore();

        return response()->json($jenisPidana);
    }
}
