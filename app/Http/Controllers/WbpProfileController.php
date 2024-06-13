<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Kasus;
use Ramsey\Uuid\Uuid;
use App\Helpers\Helpers;
use App\Models\WbpProfile;
use Illuminate\Support\Str;
use App\Helpers\ApiResponse;
use App\Models\AksesRuangan;
use Illuminate\Http\Request;
use App\Models\PivotKasusWbp;
use App\Models\PivotKasusSaksi;
use App\Models\PivotKasusOditur;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\KasusRequest;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\WbpProfileRequest;
use App\Http\Resources\WbpProfileResource;


class WbpProfileController extends Controller
{
    public function index(Request $request)
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
            use (
                $nrp,
                $nama,
                $is_isolated,
                $alamat,
                $nama_pangkat,
                $nama_lokasi_kesatuan,
                $nama_lokasi_lemasmil,
                $nama_lokasi_otmil,
                $vonis_bulan,
                $vonis_tahun,
                $nama_kategori_perkara,
                $nama_hunian_wbp_otmil,
                $nama_matra,
                $nama_hunian_wbp_lemasmil,
                $nama_kesatuan,
                $tanggal_penetapan_tersangka,
                $tanggal_penetapan_terdakwa,
                $tanggal_penetapan_terpidana,
                $tanggal_ditahan_otmil,
                $tanggal_ditahan_lemasmil,
                $tanggal_masa_penahanan_otmil
            ) {
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

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = WbpProfileResource::collection($paginatedData);
            return ApiResponse::pagination($resourceCollection);
            // $paginatedData = $query->paginate($perPage);
            return ApiResponse::success([
                'data' => WbpProfileResource::collection($paginatedData),
                'pagination' => [
                    'totalRecords' => $paginatedData->total(),
                    'pageSize' => $paginatedData->perPage(),
                    'currentPage' => $paginatedData->currentPage(),
                    'totalPages' => $paginatedData->lastPage(),
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

    public function create(Request $request)
    {
        $uuid = Uuid::uuid4()->toString();
        $base64Image = $request['foto_wajah'];
        $image = Helpers::HandleImageBase64($base64Image);
        try {
            DB::beginTransaction();

            $validationExistWbp = WbpProfile::where('nrp', $request['nrp'])->first();
            if ($validationExistWbp) {
                return response()->json([
                    'status' => 'Failed',
                    'message' => 'WbpProfile with this NRP already exists.',
                ], 409);
            }

            $kasusData = null;

            if ($request['is_new_kasus']) {
                $kasusData = Kasus::create([
                    'nama_kasus' => $request['nama_kasus'],
                    'nomor_kasus' => $request['nomor_kasus'],
                    'wbp_profile_id' => $uuid,
                    'kategori_perkara_id' => $request['kategori_perkara_id'],
                    'jenis_perkara_id' => $request['jenis_perkara_id'],
                    'lokasi_kasus' => $request['lokasi_kasus'],
                    'waktu_kejadian' => $request['waktu_kejadian'],
                    'tanggal_pelimpahan_kasus' => $request['tanggal_pelimpahan_kasus'],
                    'waktu_pelaporan_kasus' => $request['waktu_pelaporan_kasus'],
                    'zona_waktu' => $request['zona_waktu'],
                    'tanggal_mulai_penyidikan' => $request['tanggal_mulai_penyidikan'],
                    'tanggal_mulai_sidang' => $request['tanggal_mulai_sidang'],
                ]);

                foreach ($request['wbp_profile_ids'] as $index => $wbp_profile_id) {
                    $request_keterangan = $request['keterangans'];
                    $keterangan = $request_keterangan[$index];

                    $PivotKasusWbp = PivotKasusWbp::create([
                        'kasus_id' => $kasusData->id,
                        'wbp_profile_id' => $wbp_profile_id,
                        'keterangan' => $keterangan,
                    ]);
                };

                // $PivotKasusWbpNew = PivotKasusWbp::create([
                //     'kasus_id' => $kasusData->id,
                //     'wbp_profile_id' => $uuid,
                //     'keterangan' => "Tersangka",
                // ]);

                $oditur_penyidik_ids = $request['oditur_penyidik_id'];
                $role_ketua_oditur_ids = $request['role_ketua_oditur_ids'];
                foreach ($oditur_penyidik_ids as $oditur_penyidik_id) {
                    $role = ($oditur_penyidik_id == $role_ketua_oditur_ids) ? 1 : 0;
                    $PivotKasusOditur = PivotKasusOditur::create([
                        'kasus_id' => $kasusData->id,
                        'role_ketua' => $role,
                        'oditur_penyidikan_id' => $oditur_penyidik_id
                    ]);
                };

                $saksi_ids = $request['saksi_id'];
                $keteranganSaksis = $request['keteranganSaksis'];
                foreach ($saksi_ids as $index => $saksi) {
                    $keterangan = $keteranganSaksis[$index];
                    $PivotKasusSaksi = PivotKasusSaksi::create([
                        'kasus_id' => $kasusData->id,
                        'saksi_id' => $saksi,
                        'keterangan' => $keterangan
                    ]);
                }
            }

            $wbpProfile = WbpProfile::create([
                'id' => $uuid,
                'nama' => $request['nama'],
                'pangkat_id' => $request['pangkat_id'],
                'kesatuan_id' => $request['kesatuan_id'],
                'tempat_lahir' => $request['tempat_lahir'],
                'tanggal_lahir' => $request['tanggal_lahir'],
                'jenis_kelamin' => $request['jenis_kelamin'],
                'provinsi_id' => $request['provinsi_id'],
                'kota_id' => $request['kota_id'],
                'alamat' => $request['alamat'],
                'agama_id' => $request['agama_id'],
                'status_kawin_id' => $request['status_kawin_id'],
                'pendidikan_id' => $request['pendidikan_id'],
                'bidang_keahlian_id' => $request['bidang_keahlian_id'],
                'foto_wajah' => $image, // Store the image name in the database
                'nomor_tahanan' => $request['nomor_tahanan'],
                'residivis' => $request['residivis'],
                'status_wbp_kasus_id' => $request['status_wbp_kasus_id'],
                'foto_wajah_fr' => $base64Image,
                'is_isolated' => $request['is_isolated'],
                'is_sick' => $request['is_sick'],
                'wbp_sickness' => $request['wbp_sickness'],
                'gelang_id' => $request['gelang_id'],
                'hunian_wbp_otmil_id' => $request['hunian_wbp_otmil_id'],
                'hunian_wbp_lemasmil_id' => $request['hunian_wbp_lemasmil_id'],
                'status_keluarga' => $request['status_keluarga'],
                'nama_kontak_keluarga' => $request['nama_kontak_keluarga'],
                'hubungan_kontak_keluarga' => $request['hubungan_kontak_keluarga'],
                'nomor_kontak_keluarga' => $request['nomor_kontak_keluarga'],
                'matra_id' => $request['matra_id'],
                'nrp' => $request['nrp'],
                'tanggal_ditahan_otmil' => $request['tanggal_ditahan_otmil'],
                'tanggal_ditahan_lemasmil' => $request['tanggal_ditahan_lemasmil'],
                'tanggal_penetapan_tersangka' => $request['tanggal_penetapan_tersangka'],
                'tanggal_penetapan_terdakwa' => $request['tanggal_penetapan_terdakwa'],
                'tanggal_penetapan_terpidana' => $request['tanggal_penetapan_terpidana'],
                'kasus_id' => $request['is_new_kasus'] ? $kasusData->id : $request['kasus_id'],
                'is_diperbantukan' => $request['is_diperbantukan'],
                'tanggal_masa_penahanan_otmil' => $request['tanggal_masa_penahanan_otmil'],
            ]);

            $DMAC = $request['DMAC'];
            $nama_gateway = $request['nama_gateway'];
            $akses_ruangan_otmil_id = $request['akses_ruangan_otmil_id'];

            foreach ($akses_ruangan_otmil_id as $akses_otmil) {
                $AksesRuangan = AksesRuangan::create([
                    'dmac' => $DMAC,
                    'nama_gateway' => $nama_gateway,
                    'ruangan_otmil_id' => $akses_otmil["id"],
                    'ruangan_lemasmil_id' => null,
                    'is_permitted' => $akses_otmil["isPermitted"],
                    'wbp_profile_id' => $wbpProfile->id
                ]);
            }
            DB::commit();

            return response()->json([
                'status' => 'OK',
                'message' => 'Successfully created data.',
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'Failed',
                'message' => 'Failed to create data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            // return $request['foto_wajah'];
            // exit();
            DB::beginTransaction();
            $findWbp = WbpProfile::where('id', $request['wbp_profile_id'])->first();
            // if(empty($findWbp)){
            //     return response()->json([
            //         'status' => 'Failed',
            //         'message' => 'WbpProfile with this NRP already exists.',
            //     ], 404);
            // }

            $kasusData = null;
            if ($request['is_new_kasus'] == "true" || $request['is_new_kasus'] == true) {
                $kasusData = Kasus::create([
                    'nama_kasus' => $request['nama_kasus'],
                    'nomor_kasus' => $request['nomor_kasus'],
                    'wbp_profile_id' => $request['wbp_profile_id'],
                    'kategori_perkara_id' => $request['kategori_perkara_id'],
                    'jenis_perkara_id' => $request['jenis_perkara_id'],
                    'lokasi_kasus' => $request['lokasi_kasus'],
                    'waktu_kejadian' => $request['waktu_kejadian'],
                    'tanggal_pelimpahan_kasus' => $request['tanggal_pelimpahan_kasus'],
                    'waktu_pelaporan_kasus' => $request['waktu_pelaporan_kasus'],
                    'zona_waktu' => $request['zona_waktu'],
                    'tanggal_mulai_penyidikan' => $request['tanggal_mulai_penyidikan'],
                    'tanggal_mulai_sidang' => $request['tanggal_mulai_sidang'],
                ]);

                $updatePivotKasus = PivotKasusWbp::where('kasus_id', $request['existing_kasus_id'])->where('wbp_profile_id', $request['wbp_profile_id'])
                    ->update([
                        'kasus_id' => $kasusData->id,
                        "keterangan" => "Tersangka"
                    ]);

                $existingKasusId = $request['existing_kasus_id'];
                $findKasus = Kasus::where('id', $existingKasusId)->first();

                $deletePivotKasus = PivotKasusWbp::where('kasus_id', $existingKasusId)
                    ->where('wbp_profile_id', '!=', $findKasus->wbp_profile_id)
                    ->forceDelete();
                foreach ($request['wbp_profile_ids'] as $index => $wbp_profile_id) {
                    $request_keterangan = $request['keterangans'];
                    $keterangan = $request_keterangan[$index];

                    $PivotKasusWbp = PivotKasusWbp::create([
                        'kasus_id' => $kasusData->id,
                        'wbp_profile_id' => $wbp_profile_id,
                        'keterangan' => $keterangan,
                    ]);

                    $oditur_penyidik_ids = $request['oditur_penyidik_id'];
                    $role_ketua_oditur_ids = $request['role_ketua_oditur_ids'];
                    foreach ($oditur_penyidik_ids as $oditur_penyidik_id) {
                        $role = ($oditur_penyidik_id == $role_ketua_oditur_ids) ? 1 : 0;
                        $PivotKasusOditur = PivotKasusOditur::create([
                            'kasus_id' => $kasusData->id,
                            'role_ketua' => $role,
                            'oditur_penyidikan_id' => $oditur_penyidik_id
                        ]);
                    };

                    $saksi_ids = $request['saksi_id'];
                    $keteranganSaksis = $request['keteranganSaksis'];
                    foreach ($saksi_ids as $index => $saksi) {
                        $keterangan = $keteranganSaksis[$index];
                        $PivotKasusSaksi = PivotKasusSaksi::create([
                            'kasus_id' => $kasusData->id,
                            'saksi_id' => $saksi,
                            'keterangan' => $keterangan
                        ]);
                    }
                };
            } else if ($request['is_new_kasus'] == "false" || $request['is_new_kasus'] == false) {
                $kasus_id = $request['kasus_id'];
                $updatePivotKasus = PivotKasusWbp::where('kasus_id', $request['existing_kasus_id'])->where('wbp_profile_id', $request['wbp_profile_id'])
                    ->update([
                        'kasus_id' => $kasus_id,
                        "keterangan" => "Tersangka"
                    ]);
            }

            $image = $request['foto_wajah'];
            if (strpos($image, 'data:image/') === 0 && $image != $findWbp->foto_wajah) {
                $image = Helpers::HandleImageBase64($image);
            }
            $data_foto_wajah_fr = $request['foto_wajah'] == $findWbp->foto_wajah_fr ? $findWbp->foto_wajah_fr : $request['foto_wajah'];
            $UpdateWbp = WbpProfile::where('id', $request['wbp_profile_id'])
                ->update([
                    'nama' => $request['nama'],
                    'pangkat_id' => $request['pangkat_id'],
                    'kesatuan_id' => $request['kesatuan_id'],
                    'tempat_lahir' => $request['tempat_lahir'],
                    'tanggal_lahir' => $request['tanggal_lahir'],
                    'jenis_kelamin' => $request['jenis_kelamin'],
                    'provinsi_id' => $request['provinsi_id'],
                    'kota_id' => $request['kota_id'],
                    'alamat' => $request['alamat'],
                    'agama_id' => $request['agama_id'],
                    'status_kawin_id' => $request['status_kawin_id'],
                    'pendidikan_id' => $request['pendidikan_id'],
                    'bidang_keahlian_id' => $request['bidang_keahlian_id'],
                    'nomor_tahanan' => $request['nomor_tahanan'],
                    'is_isolated' => $request['is_isolated'],
                    'is_sick' => $request['is_sick'],
                    'wbp_sickness' => $request['wbp_sickness'],
                    'gelang_id' => $request['gelang_id'],
                    'nama_kontak_keluarga' => $request['nama_kontak_keluarga'],
                    'hubungan_kontak_keluarga' => $request['hubungan_kontak_keluarga'],
                    'nomor_kontak_keluarga' => $request['nomor_kontak_keluarga'],
                    'hunian_wbp_lemasmil_id' => $request['hunian_wbp_lemasmil_id'],
                    'hunian_wbp_otmil_id' => $request['hunian_wbp_otmil_id'],
                    'matra_id' => $request['matra_id'],
                    'nrp' => $request['nrp'],
                    'kasus_id' => $request['is_new_kasus'] ? $kasusData->id : $request['kasus_id'],
                    'status_wbp_kasus_id' => $request['status_wbp_kasus_id'],
                    'residivis' => $request['residivis'],
                    'tanggal_penetapan_tersangka' => $request['tanggal_penetapan_tersangka'],
                    'tanggal_penetapan_terdakwa' => $request['tanggal_penetapan_terdakwa'],
                    'tanggal_penetapan_terpidana' => $request['tanggal_penetapan_terpidana'],
                    'foto_wajah' => $image,
                    'foto_wajah_fr' => $data_foto_wajah_fr,
                ]);

            $deleteAksesRuangan = AksesRuangan::where('wbp_profile_id', $request['wbp_profile_id'])->forceDelete();

            $DMAC = $request['DMAC'];
            $nama_gateway = $request['nama_gateway'];
            $akses_ruangan_otmil_id = $request['akses_ruangan_otmil_id'];

            foreach ($akses_ruangan_otmil_id as $akses_otmil) {
                $AksesRuangan = AksesRuangan::create([
                    'dmac' => $DMAC,
                    'nama_gateway' => $nama_gateway,
                    'ruangan_otmil_id' => $akses_otmil["id"],
                    'ruangan_lemasmil_id' => null,
                    'is_permitted' => $akses_otmil["isPermitted"],
                    'wbp_profile_id' => $request['wbp_profile_id']
                ]);
            }
            DB::commit();

            return response()->json([
                'status' => 'OK',
                'message' => 'Successfully updated data.',
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'Failed',
                'message' => 'Failed to create data.',
                'error' => $e->getMessage(),
            ], 500);
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
