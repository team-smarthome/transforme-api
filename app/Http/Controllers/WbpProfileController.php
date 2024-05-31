<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WbpProfile;
use App\Helpers\ApiResponse;
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
                'statusKawin',
                'pendidikan',
                'bidangKeahlian',
                'statusWbpKasus',
                'gelang',
                'hunianWbpOtmil.lokasiOtmil',
                'hunianWbpLemasmil',
                'matra',
                'kasus.jenisPerkara.kategoriPerkara',
                'aksesRuangan.ruanganOtmilAkses',
                'aksesRuangan.ruanganLemasmilAkses',
            ])->where(function ($query)
            use ($nrp, $nama, $is_isolated, $alamat, $tanggal_penetapan_tersangka, $tanggal_penetapan_terdakwa, $tanggal_penetapan_terpidana, $tanggal_ditahan_otmil, $tanggal_ditahan_lemasmil, $tanggal_masa_penahanan_otmil) {
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

    public function store(WbpProfileRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            // Set default value for is_sick if not provided
            if (!isset($data['is_sick'])) {
                $data['is_sick'] = 0;
            }

            // Set tanggal_lahir to null if empty or '0000-00-00'
            if (!empty($data['tanggal_lahir']) && $data['tanggal_lahir'] === '0000-00-00') {
                $data['tanggal_lahir'] = null;
            }

            // Handle foto_wajah
            if ($request->has('foto_wajah')) {
                $base64Image = $request->input('foto_wajah');

                $image = str_replace('data:image/jpeg;base64,', '', $base64Image);
                $image = str_replace(' ', '+', $image);
                $image = base64_decode($image);

                $imageName = Str::uuid() . '.jpeg';

                Storage::disk('public')->makeDirectory('wbp_profile_images');
                $filePath = 'wbp_profile_images/' . str_replace('\\', '/', $imageName);
                Storage::disk('public')->put($filePath, $image);

                $data['foto_wajah'] = $imageName;
            }

            // Handle kasus_id
            if (empty($data['kasus_id'])) {
                // Check if nama_kasus is provided

                // Create new kasus entry if kasus_id is empty
                $data['kasus_id'] = '';

                $kasusData = [
                    'nama_kasus' => $data['nama_kasus'] ?? null,
                    'nomor_kasus' => $data['nomor_kasus'] ?? null,
                    'wbp_profile_id' => $data['wbp_profile_id'] ?? null,
                    'kategori_perkara_id' => $data['kategori_perkara_id'] ?? null,
                    'jenis_perkara_id' => $data['jenis_perkara_id'] ?? null,
                    'lokasi_kasus' => $data['lokasi_kasus'] ?? null,
                    'waktu_kejadian' => $data['waktu_kejadian'] ?? null,
                    'tanggal_pelimpahan_kasus' => $data['tanggal_pelimpahan_kasus'] ?? null,
                    'waktu_pelaporan_kasus' => $data['waktu_pelaporan_kasus'] ?? null,
                    'zona_waktu' => $data['zona_waktu'] ?? null,
                    'tanggal_mulai_penyidikan' => $data['tanggal_mulai_penyidikan'] ?? null,
                    'tanggal_mulai_sidang' => $data['tanggal_mulai_sidang'] ?? null,
                ];

                $kasus = Kasus::create($kasusData);
                $data['kasus_id'] = $kasus->id;
            } else {
                // Set kasus_id to empty string if provided
                // $data['kasus_id'] = '';
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




    // public function store(WbpProfileRequest $request)
    // {
    //     try {
    //         $data = $request->validated();

    //         if (!isset($data['is_sick'])) {
    //             $data['is_sick'] = 0;
    //         }

    //         if (!empty($data['tanggal_lahir']) && $data['tanggal_lahir'] === '0000-00-00') {
    //             $data['tanggal_lahir'] = null;
    //         }

    //         $wbpProfile = WbpProfile::create($data); // Simpan entitas

    //         // Refresh entitas dari database untuk mendapatkan ID yang baru saja disimpan
    //         $wbpProfile->refresh();

    //         // Dapatkan ID dari entitas yang baru saja disimpan
    //         $id = $wbpProfile->id;

    //         if ($request->has('foto_wajah')) {
    //             $base64Image = $request->input('foto_wajah');

    //             // Buat nama file foto berdasarkan ID
    //             $imageName = $id . '.jpeg';
    //             $filePath = str_replace('\\', '/', $imageName);
    //             Storage::disk('public')->put($filePath, $base64Image);

    //             // Simpan file foto dengan nama yang telah Anda buat
    //             // Storage::disk('public')->put('foto_wajah/' . $imageName, base64_decode($base64Image));

    //             // Simpan nama file foto ke dalam entitas
    //             $wbpProfile->update(['foto_wajah' => $imageName]);
    //         }

    //         return response()->json([
    //             'status' => 'OK',
    //             'message' => 'Successfully created data.',
    //         ], 201);
    //     } catch (\Exception $e) {
    //         return ApiResponse::error('Failed to create data.', $e->getMessage());
    //     }
    // }
}
