<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\AksesRuangan;

class AksesRuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
     try {
        $keyword = $request->input('search');

        $getData = AksesRuangan::with(['wbpProfile', 'ruanganOtmil', 'ruanganLemasmil'])
        ->where('dmac', 'LIKE', '%' . $keyword . '%')
        ->orWhere('nama_gateway', 'LIKE', '%' . $keyword . '%')
        ->orWhereHas('wbpProfile', function ($q) use ($keyword) {
            $q->where('nama', 'LIKE', '%' . $keyword . '%');
        })
        ->orWhereHas('ruanganOtmil', function ($r) use ($keyword) {
            $r->where('nama_ruangan_otmil', 'LIKE', '%' . $keyword . '%');
        })
        ->orWhereHas('ruanganLemasmil', function ($s) use ($keyword) {
            $s->where('nama_ruangan_lemasmil', 'LIKE', '%' . $keyword . '%');
        })->get();
        return ApiResponse::success($getData);
    } catch (\Exception $e) {
        return ApiResponse::error('An error occurred while fetching data.', $e->getMessage());
     }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $request->validate([
                "dmac" => 'required|string',
                "nama_gateway" => 'required|string',
                "ruangan_otmil_id" => 'string',
                "ruangan_lemasmil_id" => 'string',
                "is_permitted" => 'required',
                "wbp_profile_id" => 'required|string',
            ]);
            $insert = AksesRuangan::create($request->all());
            return ApiResponse::success([
                'data' => $insert
            ]);
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred while fetching data.', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            $request->validate([
                "dmac" => 'required|string',
                "nama_gateway" => 'required|string',
                "ruangan_otmil_id" => 'string',
                "ruangan_lemasmil_id" => 'string',
                "is_permitted" => 'required',
                "wbp_profile_id" => 'required|string',
            ]);
            $akses_id = $request->input('id');
            $findAksesRuangan = AksesRuangan::where('id', $akses_id)->firstOrFail();
            $findAksesRuangan->nama_gateway = $request->input('nama_gateway');
            $findAksesRuangan->ruangan_otmil_id = $request->input('ruangan_otmil_id');
            $findAksesRuangan->ruangan_lemasmil_id = $request->input('ruangan_lemasmil_id');
            $findAksesRuangan->is_permitted = $request->input('is_permitted');
            $findAksesRuangan->wbp_profile_id = $request->input('wbp_profile_id');

            $findAksesRuangan->save();
            return ApiResponse::updated();
        }
        catch (\Exception $e) {
                return ApiResponse::error('An error occurred while fetching data.', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $akses_id = $request->input('id');
            $akses_ruangan = AksesRuangan::findOrFail($akses_id);
            $akses_ruangan->delete();
            return ApiResponse::deleted();   
        }catch (\Exception $e) {
            return ApiResponse::error('An error occurred while fetching data.', $e->getMessage());
        }
    }
}
