<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\HunianWbpOtmil;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\HunianWbpOtmilResource;

class HunianWbpOtmilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input("search");

        $findData = HunianWbpOtmil::with('lokasiOtmil')->where('nama_hunian_wbp_otmil','like','%'.$keyword.'%')->get();

        return ApiResponse::success([
            'data' => HunianWbpOtmilResource::collection($findData)
        ]);
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
            'lokasi_otmil_id' => 'required|string|max:100',
            'nama_hunian_wbp_otmil' => 'required|string|max:100'
        ]);

        $hunianWbpOtmil = HunianWbpOtmil::create($request->all());
        return ApiResponse::success([
            'data' => new HunianWbpOtmilResource($hunianWbpOtmil)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hunianWbpOtmil = HunianWbpOtmil::findOrFail( $id );
        return response()->json($hunianWbpOtmil, 200);
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
        $request->validate([
            'lokasi_otmil_id' => 'required|string|max:100',
            'nama_hunian_wbp_otmil' => 'required|string|max:100'
        ]);

        $hunianWbpOtmil = HunianWbpOtmil::findOrFail( $id );

        $existingHunianWbpOtmil = HunianWbpOtmil::where('nama_hunian_wbp_otmil', $hunianWbpOtmil->nama_hunian_wbp_otmil)->first();

        if ($existingHunianWbpOtmil && $existingHunianWbpOtmil->id !== $id) {
            return ApiResponse::error('Nama hunian wbp otmil sudah ada.', null, 422);
        }

        $hunianWbpOtmil->update($request->all());
        return ApiResponse::success([
            'data' => new HunianWbpOtmilResource($hunianWbpOtmil)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hunianWbpOtmil = HunianWbpOtmil::findOrFail($id);
        $hunianWbpOtmil->delete();

        return ApiResponse::deleted();
    }

    public function restore($id){
        $hunianWbpOtmil = HunianWbpOtmil::withTrashed()->findOrFail($id);
        $hunianWbpOtmil->restore();

        return response()->json($hunianWbpOtmil);
    }
}
