<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\AksesRuanganResource;
use App\Models\AksesRuangan;
use Illuminate\Http\Request;

class AksesRuanganController extends Controller
{
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
}
