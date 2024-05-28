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
        $keyword = $request->input("search");

        $findData = JenisPerkara::with("kategoriPerkara")->where("nama_jenis_perkara","LIKE","%".$keyword."%")->get();

        return ApiResponse::success(['data' => JenisPerkaraResource::collection($findData)]);
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

        return ApiResponse::success(['data'=> new JenisPerkaraResource($jenisPerkara)]);
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
