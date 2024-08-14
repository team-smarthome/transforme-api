<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\JenisPerkara;
use App\Http\Resources\JenisPerkaraResource;

class JenisPerkaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = JenisPerkara::with('kategoriPerkara');
            $filterData = [
                'kategori_perkara_id' => 'kategori_perkara_id',
                'nama_kategori_perkara' => 'kategoriPerkara.nama_kategori_perkara',
                'nama_jenis_perkara' => 'nama_jenis_perkara',
                'pasal' => 'pasal',
                'vonis_tahun_perkara' => 'vonis_tahun_perkara',
                'vonis_bulan_perkara' => 'vonis_bulan_perkara',
                'vonis_hari_perkara' => 'vonis_hari_perkara',
                'jenis_pidana_id' => 'kategoriPerkara.jenis_pidana_id'
            ];

            foreach ($filterData as $requestKey => $column) {
                if ($request->has($requestKey)) {
                    if ($requestKey == 'nama_kategori_perkara') {
                        $query->whereHas('kategoriPerkara', function ($q) use ($request, $requestKey) {
                            $q->where('nama_kategori_perkara', 'like', '%' . $request->input($requestKey) . '%');
                        });
                    } else {
                        $query->where($column, 'LIKE', '%' . $request->input($requestKey) . '%');
                    }
                }
            }

            if ($request->has('nama_kategori_perkara')) {
                $query->whereHas('kategoriPerkara', function ($q) use ($request) {
                    $q->where('nama_kategori_perkara', 'like', '%' . $request->input('nama_kategori_perkara') . '%');
                });
            }


            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = JenisPerkaraResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
        } catch (\Exception $e) {
            return ApiResponse::error('Failed get data.', $e->getMessage());
        }

        return ApiResponse::success(
            [
                'data' => JenisPerkaraResource::collection($query)
            ]
        );
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
            'kategori_perkara_id' => 'required|string|max:100',
            'nama_jenis_perkara' => 'required|string|max:100',
            'pasal' => 'required|string|max:100',
            'vonis_tahun_perkara' => 'nullable|integer|min:0|max:100',
            'vonis_bulan_perkara' => 'nullable|integer|min:0|max:11',
            'vonis_hari_perkara' => 'nullable|integer|min:0|max:31',
        ]);

        $jenisPerkara = JenisPerkara::create($request->all());

        return ApiResponse::created();
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
            $jenisPerkara = $request->input('jenis_perkara_id');

            $jenisPerkara = JenisPerkara::findOrFail($jenisPerkara);
            $jenisPerkara->update($request->all());

            return ApiResponse::updated();

        } catch (\Exception $e) {
            return ApiResponse::error('Failed update data.', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $jenisPerkara = JenisPerkara::findOrFail($request->input('jenis_perkara_id'));
            $jenisPerkara->delete();

            return ApiResponse::deleted();
        } catch (\Exception $e) {
            return ApiResponse::error('Failed delete data.', $e->getMessage());
        }
    }
}
