<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RuanganLemasmil;
use App\Http\Requests\RuanganLemasmilRequest;
use App\Http\Resources\RuanganLemasmilResource;
use App\Helpers\ApiResponse;
use Exception;

class RuanganLemasmilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   try {
            $query = RuanganLemasmil::with(['lokasiLemasmil', 'lantaiLemasmil', 'zona']);
            $filterableColumns = [
                'ruangan_lemasmil_id' => 'id',
                'nama_ruangan_lemasmil' => 'nama_ruangan_lemasmil',
                'lokasi_lemasmil_id' => 'lokasi_lemasmil_id',
                'nama_lokasi_lemasmil' => 'lokasiLemasmil.nama_lokasi_lemasmil',
                'lantai_lemasmil_id' => 'lantai_lemasmil_id',
                'nama_lantai' => 'lantaiLemasmil.nama_lantai',
                'zona_id' => 'zona_id',
                'nama_zona' => 'zona.nama_zona'
            ];

            $filters = request()->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
                }
            }

            $query->latest();

            $paginatedData = $query->paginate(request()->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = RuanganLemasmilResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection);

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
    public function store(RuanganLemasmilRequest $request)
    {
        try {
            $ruanganLemasmil = new RuanganLemasmil([
                'nama_ruangan_lemasmil' => $request->nama_ruangan_lemasmil,
                'lokasi_lemasmil_id' => $request->lokasi_lemasmil_id,
                'zona_id' => $request->zona_id,
                'lantai_lemasmil_id' => $request->lantai_lemasmil_id,
            ]);
            if(RuanganLemasmil::where('nama_ruangan_lemasmil', $request->nama_ruangan_lemasmil)->exists()) {
                return ApiResponse::error('Failed to create Data.', 'Nama Ruangan Lemasmil already exists');
            }

            if($ruanganLemasmil->save()) {
                return ApiResponse::success('Data created successfully', $ruanganLemasmil);
            } else {
                return ApiResponse::error('Failed to create Data.', 'Data not saved');
            }

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
    public function update(RuanganLemasmilRequest $request)
    {
        try {
            $id = $request->input('ruangan_lemasmil_id');
            $ruanganLemasmil = RuanganLemasmil::findOrfail($id);
            if(!$ruanganLemasmil) {
                return ApiResponse::error('Data not found', 'Data not found', 404);
            }

            $ruanganLemasmil->nama_ruangan_lemasmil = $request->nama_ruangan_lemasmil;
            $ruanganLemasmil->lokasi_lemasmil_id = $request->lokasi_lemasmil_id;
            $ruanganLemasmil->zona_id = $request->zona_id;
            $ruanganLemasmil->lantai_lemasmil_id = $request->lantai_lemasmil_id;

            if($ruanganLemasmil->save()) {
                return ApiResponse::success('Data updated successfully', $ruanganLemasmil);
            } else {
                return ApiResponse::error('Failed to update Data.', 'Data not saved');
            }

        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
    
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
            $id = $request->input('ruangan_lemasmil_id');
            $ruanganLemasmil = RuanganLemasmil::findOrFail($id);
            if ($ruanganLemasmil->delete()) {
                return ApiResponse::deleted();
            } else {
                return ApiResponse::error('Failed to delete data.', 'Failed to delete data.', 500);
            }
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
    
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
    }
}
