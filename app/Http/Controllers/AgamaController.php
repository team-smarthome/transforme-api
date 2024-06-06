<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\Agama;
use App\Http\Resources\AgamaResource;
use Illuminate\Database\QueryException;
use Exception;
use App\Http\Requests\AgamaRequest;


class AgamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    { 
        try {
            $query = Agama::query();
            $filterableColumns = [
                'agama_id' => 'id',
                'nama_agama' => 'nama_agama',
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
                }
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
                        
            $resourceCollection = AgamaResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection);

        } catch (Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
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
    public function store(AgamaRequest $request)
    {
        try {
            $agama = Agama::create($request->validated());

            return ApiResponse::created($agama);
    
        } catch (QueryException $e) {
            // Menangani kesalahan query database, seperti pelanggaran constraint unik
            return ApiResponse::error('Database error', $e->getMessage(), 500);
    
        } catch (Exception $e) {
            // Menangani semua kesalahan lain yang tidak terduga
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agama = Agama::findOrFail($id);

        return response()->json($agama, 200);
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
    public function update(AgamaRequest $request, string $id)
    {
        $agama = Agama::findOrFail($id);

        $namaEditAgama = $request->input('nama_agama');
        $existingAgama = Agama::where('nama_agama', $agama->nama_agama)->first();

        if ($existingAgama && $existingAgama->id !== $id) {
            return ApiResponse::error('Nama agama sudah ada.', null, 422);
        }

        $agama->update($request->all());

        return ApiResponse::updated($agama);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agama = Agama::findOrFail($id);    
        $agama->delete();

        return ApiResponse::deleted();
    }

    public function restore($id)
    {
        $agama = Agama::withTrashed()->findOrFail($id);
        $agama->restore();

        return response()->json($agama);
    }
}

