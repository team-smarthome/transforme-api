<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Models\KategoriPerkara;
use App\Http\Resources\KategoriPerkaraResource;

class KategoriPerkaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = KategoriPerkara::query();
            $filterData = [
                'nama_kategori_perkara' => 'nama_kategori_perkara'
            ];

            // $filter = $request->input('filter', []);

            foreach ($filterData as $key => $column) {
                if ($request->has($key)) {
                    $query->where($column, 'like', '%' . $request->input($key) . '%');
                }
            }

            $query->latest();
            $paginateData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            return ApiResponse::pagination($paginateData, 'Successfully get Data');
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get data', $e->getMessage());
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
        $request->validate([
            'nama_kategori_perkara' => 'required|string|max:100',
            'jenis_pidana_id' => 'nullable|string|max:100',
        ]);

        $kategoriPerkara = KategoriPerkara::create($request->all());

        return ApiResponse::success(['data' => new KategoriPerkaraResource($kategoriPerkara)]);
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
    public function update(Request $request)
    {
        try {
            $id = $request->input('kategori_perkara_id');
            $dataKategori = KategoriPerkara::find($id);
            if (!$dataKategori) {
                return ApiResponse::notFound('Hakim not found');
            }

            $dataKategori->nama_kategori_perkara = $request->nama_kategori_perkara;
            $dataKategori->jenis_pidana_id = $request->jenis_pidana_id;

            if ($dataKategori->save()) {
                $data = $dataKategori->toArray();
                return ApiResponse::updated($data);
            } else {
                return ApiResponse::error('Failed to update kategori perkara.');
            }
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to update kategori perkara.', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('kategori_perkara_id');
            $hakim = KategoriPerkara::find($id);
            if (!$hakim) {
                return ApiResponse::notFound('kategori perkara not found.');
            }

            if ($hakim->delete()) {
                return ApiResponse::deleted();
            } else {
                return ApiResponse::error('Failed to delete kategori perkara.');
            }
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to delete kategori perkara.', $e->getMessage());
        }
    }
}
