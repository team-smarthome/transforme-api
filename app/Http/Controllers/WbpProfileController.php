<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WbpProfile;
use App\Helpers\ApiResponse;
use App\Http\Requests\KasusRequest;
use App\Http\Requests\WbpProfileRequest;
use App\Http\Resources\WbpProfileResource;
use App\Models\Kasus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;


class WbpProfileController extends Controller
{
    public function index()
    {
        $nama = request()->input('nama');
        $is_isolated = request()->input('is_isolated');
        $alamat = request()->input('alamat');
        $nama_pangkat = request()->input('nama_pangkat');
        $nama_kesatuan = request()->input('nama_kesatuan');
        $nama_lokasi_kesatuan = request()->input('nama_lokasi_kesatuan');
        $nama_lokasi_otmil = request()->input('nama_lokasi_otmil');
        $nama_lokasi_lemasmil = request()->input('nama_lokasi_lemasmil');
        $vonis_bulan = request()->input('vonis_bulan');
        $vonis_tahun = request()->input('vonis_tahun');
        $nama_kategori_perkara = request()->input('nama_kategori_perkara');
        $nama_hunian_wbp_otmil = request()->input('nama_hunian_wbp_otmil');
        $nama_hunian_wbp_lemasmil = request()->input('nama_hunian_wbp_lemasmil');
        $nama_matra = request()->input('nama_matra');
        $nrp = request()->input('nrp');
        $is_isolated = request()->input('is_isolated');
        $tanggal_penetapan_tersangka = request()->input('tanggal_penetapan_tersangka');
        $tanggal_penetapan_terdakwa = request()->input('tanggal_penetapan_terdakwa');
        $tanggal_penetapan_terpidana = request()->input('tanggal_penetapan_terpidana');
        $tanggal_ditahan_otmil = request()->input('tanggal_ditahan_otmil');
        $tanggal_ditahan_lemasmil = request()->input('tanggal_ditahan_lemasmil');
        $tanggal_masa_penahanan_otmil = request()->input('tanggal_masa_penahanan_otmil');
        $perPage = request()->input('per_page', 10);

        try {
            $query = WbpProfile::with([
                'pangkat',
                'kesatuan.lokasiKesatuan',
                'provinsi',
                'kota',
                'agama',
                'pangkat',
                'kesatuan',
                'statusKawin',
                'pendidikan',
                'bidangKeahlian',
                'statusWbpKasus',
                'gelang',
                'hunianWbpOtmil.lokasiOtmil',
                'hunianWbpLemasmil.lokasiLemasmil',
                'matra',
                'kasus.jenisPerkara.kategoriPerkara',
                'aksesRuangan.ruanganOtmilAkses',
                'aksesRuangan.ruanganLemasmilAkses',
            ])->where(function ($query)
            use ($nrp, $nama, $is_isolated, $alamat, $nama_pangkat, $nama_lokasi_kesatuan, $nama_lokasi_lemasmil, $nama_lokasi_otmil, $vonis_bulan, $vonis_tahun, $nama_kategori_perkara, $nama_hunian_wbp_otmil, $nama_matra,
            $nama_hunian_wbp_lemasmil, $nama_kesatuan, $tanggal_penetapan_tersangka, $tanggal_penetapan_terdakwa, $tanggal_penetapan_terpidana, $tanggal_ditahan_otmil, $tanggal_ditahan_lemasmil, $tanggal_masa_penahanan_otmil) {
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

                if (!empty($nama_pangkat)) {
                    $query->orWhereHas('pangkat', function ($q) use ($nama_pangkat) {
                        $q->where('nama_pangkat', 'LIKE', '%' . $nama_pangkat . '%');
                    });
                }

                if (!empty($nama_kesatuan)) {
                    $query->orWhereHas('kesatuan', function ($q) use ($nama_kesatuan) {
                        $q->where('nama_kesatuan', 'LIKE', '%' . $nama_kesatuan . '%');
                    });
                }

                if (!empty($nama_lokasi_kesatuan)) {
                    $query->orWhereHas('kesatuan.lokasiKesatuan', function ($q) use ($nama_lokasi_kesatuan) {
                        $q->where('nama_lokasi_kesatuan', 'LIKE', '%' . $nama_lokasi_kesatuan . '%');
                    });
                }
                if (!empty($nama_lokasi_otmil)) {
                    $query->orWhereHas('hunianWbpOtmil.lokasiOtmil', function ($q) use ($nama_lokasi_otmil) {
                        $q->where('nama_lokasi_otmil', 'LIKE', '%' . $nama_lokasi_otmil . '%');
                    });
                }
                if (!empty($nama_lokasi_lemasmil)) {
                    $query->orWhereHas('hunianWbpLemasmil.lokasiLemasmil', function ($q) use ($nama_lokasi_lemasmil) {
                        $q->where('nama_lokasi_lemasmil', 'LIKE', '%' . $nama_lokasi_lemasmil . '%');
                    });
                }
                if (!empty($vonis_bulan)) {
                    $query->orWhereHas('kasus.jenisPerkara', function ($q) use ($vonis_bulan) {
                        $q->where('vonis_bulan_perkara', 'LIKE', '%' . $vonis_bulan . '%');
                    });
                }
                if (!empty($vonis_tahun)) {
                    $query->orWhereHas('kasus.jenisPerkara', function ($q) use ($vonis_tahun) {
                        $q->where('vonis_tahun_perkara', 'LIKE', '%' . $vonis_tahun . '%');
                    });
                }
                if (!empty($nama_kategori_perkara)) {
                    $query->orWhereHas('kasus.jenisPerkara.kategoriPerkara', function ($q) use ($nama_kategori_perkara) {
                        $q->where('nama_kategori_perkara', 'LIKE', '%' . $nama_kategori_perkara . '%');
                    });
                }
                if (!empty($nama_hunian_wbp_otmil)) {
                    $query->orWhereHas('hunianWbpOtmil', function ($q) use ($nama_hunian_wbp_otmil) {
                        $q->where('nama_hunian_wbp_otmil', 'LIKE', '%' . $nama_hunian_wbp_otmil . '%');
                    });
                }
                if (!empty($nama_hunian_wbp_lemasmil)) {
                    $query->orWhereHas('hunianWbpLemasmil', function ($q) use ($nama_hunian_wbp_lemasmil) {
                        $q->where('nama_hunian_wbp_lemasmil', 'LIKE', '%' . $nama_hunian_wbp_lemasmil . '%');
                    });
                }
                if (!empty($nama_matra)) {
                    $query->orWhereHas('matra', function ($q) use ($nama_matra) {
                        $q->where('nama_matra', 'LIKE', '%' . $nama_matra . '%');
                    });
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

    public function store(WbpProfileRequest $requestWbp, KasusRequest $requestKasus)
    {
        DB::beginTransaction();

        try {
            $data = $requestWbp->validated();

            // Set default value for is_sick if not provided
            if (!isset($data['is_sick'])) {
                $data['is_sick'] = 0;
            }
            if (!empty($data['tanggal_lahir']) && $data['tanggal_lahir'] === '0000-00-00') {
                $data['tanggal_lahir'] = null;
            }

            if ($requestWbp->has('foto_wajah')) {
                $base64Image = $requestWbp->input('foto_wajah');

                $image = str_replace('data:image/jpeg;base64,', '', $base64Image);
                $image = str_replace(' ', '+', $image);
                $image = base64_decode($image);

                $imageName = Str::uuid() . '.jpeg';

                Storage::disk('public')->makeDirectory('wbp_profile_images');
                $filePath = 'wbp_profile_images/' . str_replace('\\', '/', $imageName);
                Storage::disk('public')->put($filePath, $image);

                $data['foto_wajah'] = $imageName;
            }

            $dataKasus = $requestKasus->validate();

            // Handle kasus
            if (empty($dataKasus['kasus_id'])) {
                $dataKasus['kasus_id'] = '';

                $kasusData = [
                    'nama_kasus' => $dataKasus['nama_kasus'] ?? null,
                    'nomor_kasus' => $dataKasus['nomor_kasus'] ?? null,
                    'wbp_profile_id' => $dataKasus['wbp_profile_id'] ?? null,
                    'kategori_perkara_id' => $dataKasus['kategori_perkara_id'] ?? null,
                    'jenis_perkara_id' => $dataKasus['jenis_perkara_id'] ?? null,
                    'lokasi_kasus' => $dataKasus['lokasi_kasus'] ?? null,
                    'waktu_kejadian' => $dataKasus['waktu_kejadian'] ?? null,
                    'tanggal_pelimpahan_kasus' => $dataKasus['tanggal_pelimpahan_kasus'] ?? null,
                    'waktu_pelaporan_kasus' => $dataKasus['waktu_pelaporan_kasus'] ?? null,
                    'zona_waktu' => $dataKasus['zona_waktu'] ?? null,
                    'tanggal_mulai_penyidikan' => $dataKasus['tanggal_mulai_penyidikan'] ?? null,
                    'tanggal_mulai_sidang' => $dataKasus['tanggal_mulai_sidang'] ?? null,
                ];

                $kasusData = Kasus::create($kasusData);
                $data['kasus_id'] = $kasusData->id;
            } else {
                if (!Str::isUuid($data['kasus_id'])) {
                    throw new \Exception('kasus_id must be in UUID format.');
                }
            }

            // Create wbp_profile entry
            $wbpProfile = WbpProfile::create($data);

            DB::commit();

            return response()->json([
                'status' => 'OK',
                'message' => 'Successfully created data.',
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::error('Failed to create data.', $e->getMessage());
        }
    }


    public function destroy(Request $request)
    {
        $request->validate([
            'wbp_profile_id' => 'required|string|max:36'
        ]);

        $wbpProfile_id = $request->input('wbp_profile_id');
        $dataWbpProfile = WbpProfile::where('id', $wbpProfile_id)->firstOrFail();
        $dataWbpProfile->delete();

        return ApiResponse::deleted([
            'message' => 'Data deleted successfully'
        ]);
    }
}
