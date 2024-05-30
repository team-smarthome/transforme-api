<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WbpProfile;
use App\Helpers\ApiResponse;
use App\Http\Resources\WbpProfileResource;

class WbpProfileController extends Controller
{
    public function index()
    {
        $nrp = request()->input('nrp');
        $nama = request()->input('nama');
        $is_isolated = request()->input('is_isolated');
        $alamat = request()->input('alamat');
        $tanggal_penetapan_tersangka = request()->input('tanggal_penetapan_tersangka');
        $tanggal_penetapan_terdakwa = request()->input('tanggal_penetapan_terdakwa');
        $tanggal_penetapan_terpidana = request()->input('tanggal_penetapan_terpidana');
        $tanggal_ditahan_otmil = request()->input('tanggal_ditahan_otmil');
        $tanggal_ditahan_lemasmil = request()->input('tanggal_ditahan_lemasmil');
        $tanggal_masa_penahanan_otmil = request()->input('tanggal_masa_penahanan_otmil');
        $agama_id = request()->input('agama_id');
        $ruangan_id = request()->input('ruangan_id');
        $gelang_id = request()->input('gelang_id');
        $perPage = request()->input('per_page', 10);

        try {
            $query = WbpProfile::with([
                'pangkat',
                'kesatuan.lokasiKesatuan',
                'provinsi',
                'kota',
                'agama',
                'statusKawin',
                'pendidikan',
                'bidangKeahlian',
                'statusWbpKasus',
                'gelang',
                'hunianWbpOtmil.lokasiOtmil',
                'hunianWbpLemasmil',
                'matra',
                'kasus.jenisPerkara.kategoriPerkara'
            ])->where(function ($query)
            use ($nrp, $nama, $is_isolated, $alamat, $tanggal_penetapan_tersangka, $tanggal_penetapan_terdakwa, $tanggal_penetapan_terpidana, $tanggal_ditahan_otmil, $tanggal_ditahan_lemasmil, $tanggal_masa_penahanan_otmil, $agama_id, $ruangan_id, $gelang_id) {
                if (!empty($nrp)) {
                    $query->where('nrp', 'LIKE', '%' . $nrp . '%');
                }

                if (!empty($nama)) {
                    $query->where('nama', 'LIKE', '%' . $nama . '%');
                }

                if (!empty($is_isolated)) {
                    $query->where('is_isolated', 'LIKE', '%' . $is_isolated . '%');
                }

                if (!empty($alamat)) {
                    $query->where('alamat', 'LIKE', '%' . $alamat . '%');
                }

                if (!empty($tanggal_penetapan_tersangka)) {
                    $query->where('tanggal_penetapan_tersangka', 'LIKE', '%' . $tanggal_penetapan_tersangka . '%');
                }

                if (!empty($tanggal_penetapan_terdakwa)) {
                    $query->where('tanggal_penetapan_terdakwa', 'LIKE', '%' . $tanggal_penetapan_terdakwa . '%');
                }

                if (!empty($tanggal_penetapan_terpidana)) {
                    $query->where('tanggal_penetapan_terpidana', 'LIKE', '%' . $tanggal_penetapan_terpidana . '%');
                }

                if (!empty($tanggal_ditahan_otmil)) {
                    $query->where('tanggal_ditahan_otmil', 'LIKE', '%' . $tanggal_ditahan_otmil . '%');
                }

                if (!empty($tanggal_ditahan_lemasmil)) {
                    $query->where('tanggal_ditahan_lemasmil', 'LIKE', '%' . $tanggal_ditahan_lemasmil . '%');
                }

                if (!empty($tanggal_masa_penahanan_otmil)) {
                    $query->where('tanggal_masa_penahanan_otmil', 'LIKE', '%' . $tanggal_masa_penahanan_otmil . '%');
                }

                if (!empty($agama_id)) {
                    $query->where('agama_id', 'LIKE', '%' . $agama_id . '%');
                }

                if (!empty($ruangan_id)) {
                    $query->where('ruangan_id', 'LIKE', '%' . $ruangan_id . '%');
                }

                if (!empty($gelang_id)) {
                    $query->where('gelang_id', 'LIKE', '%' . $gelang_id . '%');
                }
            });

            $paginatedData = $query->paginate($perPage);
            return ApiResponse::success([
                'data' => WbpProfileResource::collection($paginatedData),
                'pagination' => [
                    'total' => $paginatedData->total(),
                    'per_page' => $paginatedData->perPage(),
                    'current_page' => $paginatedData->currentPage(),
                    'last_page' => $paginatedData->lastPage(),
                    'from' => $paginatedData->firstItem(),
                    'to' => $paginatedData->lastItem(),
                ]
            ]);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get data.', $e->getMessage());
        }
    }
}
