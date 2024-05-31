<?php

namespace App\Http\Controllers;

use App\Http\Resources\AksesRuanganResource;
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
        $dmac = $request->input('dmac');
        $nama_gateway = $request->input('nama_gateway');
        $ruangan_otmil_id = $request->input('ruangan_otmil_id');
        $ruangan_lemasmil_id = $request->input('ruangan_lemasmil_id');
        $wbp_profile_id = $request->input('wbp_profile_id');
        $is_permitted = $request->input('is_permitted');
        $perPage = $request->input('per_page', 10);

        try {
            $query = AksesRuangan::with([
                'wbpAkses.aksesRuangan',
                'ruanganOtmilAkses.lokasiOtmil',
                'ruanganLemasmilAkses.lokasiLemasmil'
            ])->where(function ($query)
            use ($dmac, $nama_gateway, $ruangan_otmil_id, $ruangan_lemasmil_id, $wbp_profile_id, $is_permitted) {
                if (!empty($dmac)) {
                    $query->where('dmac', 'LIKE', '%' . $dmac . '%');
                }

                if (!empty($nama_gateway)) {
                    $query->where('nama_gateway', 'LIKE', '%' . $nama_gateway . '%');
                }

                if (!empty($ruangan_otmil_id)) {
                    $query->where('ruangan_otmil_id', 'LIKE', '%' . $ruangan_otmil_id . '%');
                }

                if (!empty($ruangan_lemasmil_id)) {
                    $query->where('ruangan_lemasmil_id', 'LIKE', '%' . $ruangan_lemasmil_id . '%');
                }

                if (!empty($wbp_profile_id)) {
                    $query->where('wbp_profile_id', 'LIKE', '%' . $wbp_profile_id . '%');
                }

                if (!empty($is_permitted)) {
                    $query->where('is_permitted', 'LIKE', '%' . $is_permitted . '%');
                }
            })->paginate($perPage);

            return ApiResponse::success([
                'data' => AksesRuanganResource::collection($query)
            ]);
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
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
