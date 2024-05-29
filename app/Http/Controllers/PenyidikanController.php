<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\PenyidikanResource;
use Illuminate\Http\Request;
use App\Models\Penyidikan;

class PenyidikanController extends Controller
{
    public function index()
    {
        $nrp = request()->input('nrp');
        $nama_wbp = request()->input('nama_wbp');
        $nama_saksi = request()->input('nama_saksi');
        $nip = request()->input('nip');
        $nama_oditur = request()->input('nama_oditur');
        $nama_kasus = request()->input('nama_kasus');
        $nomor_kasus = request()->input('nomor_kasus');
        $nama_jenis_perkara = request()->input('nama_jenis_perkara');
        $nama_kategori_perkara = request()->input('nama_kategori_perkara');
        $agenda_penyidikan = request()->input('agenda_penyidikan');
        $nomor_penyidikan = request()->input('nomor_penyidikan');
        $perPage = request()->input('per_page', 10);

        try {
            $query = Penyidikan::with(['kasus.jenisPerkara', 'kasus.kategoriPerkara', 'bap', 'wbp', 'saksi', 'oditurPenyidik'])
                ->where(function ($query) use ($nrp, $nama_wbp, $nama_saksi, $nip, $nama_oditur, $nama_kasus, $nomor_kasus, $nama_jenis_perkara, $nama_kategori_perkara, $agenda_penyidikan, $nomor_penyidikan) {
                    if (!empty($nrp)) {
                        $query->whereHas('wbp', function ($q) use ($nrp) {
                            $q->where('nrp', 'LIKE', '%' . $nrp . '%');
                        });
                    }

                    if (!empty($nama_wbp)) {
                        $query->whereHas('wbp', function ($q) use ($nama_wbp) {
                            $q->where('nama', 'LIKE', '%' . $nama_wbp . '%');
                        });
                    }

                    if (!empty($nama_saksi)) {
                        $query->whereHas('saksi', function ($q) use ($nama_saksi) {
                            $q->where('nama_saksi', 'LIKE', '%' . $nama_saksi . '%');
                        });
                    }

                    if (!empty($nip)) {
                        $query->whereHas('oditurPenyidik', function ($q) use ($nip) {
                            $q->where('nip', 'LIKE', '%' . $nip . '%');
                        });
                    }

                    if (!empty($nama_oditur)) {
                        $query->whereHas('oditurPenyidik', function ($q) use ($nama_oditur) {
                            $q->where('nama_oditur', 'LIKE', '%' . $nama_oditur . '%');
                        });
                    }

                    if (!empty($nama_kasus)) {
                        $query->whereHas('kasus', function ($q) use ($nama_kasus) {
                            $q->where('nama_kasus', 'LIKE', '%' . $nama_kasus . '%');
                        });
                    }

                    if (!empty($nomor_kasus)) {
                        $query->whereHas('kasus', function ($q) use ($nomor_kasus) {
                            $q->where('nomor_kasus', 'LIKE', '%' . $nomor_kasus . '%');
                        });
                    }

                    if (!empty($nama_jenis_perkara)) {
                        $query->whereHas('kasus.jenisPerkara', function ($q) use ($nama_jenis_perkara) {
                            $q->where('nama_jenis_perkara', 'LIKE', '%' . $nama_jenis_perkara . '%');
                        });
                    }

                    if (!empty($nama_kategori_perkara)) {
                        $query->whereHas('kasus.kategoriPerkara', function ($q) use ($nama_kategori_perkara) {
                            $q->where('nama_kategori_perkara', 'LIKE', '%' . $nama_kategori_perkara . '%');
                        });
                    }

                    if (!empty($agenda_penyidikan)) {
                        $query->where('agenda_penyidikan', 'LIKE', '%' . $agenda_penyidikan . '%');
                    }

                    if (!empty($nomor_penyidikan)) {
                        $query->where('nomor_penyidikan', 'LIKE', '%' . $nomor_penyidikan . '%');
                    }

                    // if (!empty($nama_kategori_perkara)) {
                    //     $query->whereHas('kas
                });

            $paginatedData = $query->paginate($perPage);
            return ApiResponse::success([
                'data' => PenyidikanResource::collection($paginatedData),
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

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nomor_penyidikan' => 'required|string|max:36',
                'kasus_id' => 'required|string|max:36',
                'waktu_dimulai_penyidikan' => 'required|string|max:100',
                'agenda_penyidikan' => 'required|string|max:100',
                'waktu_selesai_penyidikan' => 'required|string|max:100',
                'dokumen_bap_id' => 'required|string|max:100',
                'wbp_profile_id' => 'required|string|max:36',
                'saksi_id' => 'string|max:36',
                'oditur_penyidikan_id' => 'required|string|max:36',
                'zona_waktu' => 'required|string|max:100',
            ]);

            $penyidikan = Penyidikan::create($request->all());

            return ApiResponse::created([
                'data' => new PenyidikanResource($penyidikan),
            ]);

        } catch (\Exception $e) {
            return ApiResponse::error('Failed to create data.', $e->getMessage());
        }
    }
}
