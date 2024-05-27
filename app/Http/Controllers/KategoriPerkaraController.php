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
        $keyword = $request->input("search");

        $findData = KategoriPerkara::with('jenisPidana')->where('nama_kategori_perkara','like','%'.$keyword.'%')->get();

        return KategoriPerkaraResource::collection($findData);
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
            'jenis_pidana_id' => 'required|string|max:100',
        ]);

        $kategoriPerkara = KategoriPerkara::create($request->all());

        return ApiResponse::success(['data' => new KategoriPerkaraResource( $kategoriPerkara ) ]);
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
