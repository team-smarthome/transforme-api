<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\WbpPerkaraRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LokasiOtmil;
use App\Models\LokasiLemasmil;
use App\Models\Kamera;
use App\Models\Gateway;
use App\Models\Gelang;
use App\Models\KategoriPerkara;
use App\Models\WbpPerkara;

class DashboardSummaryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $filterData = $request->input('filter', []);

            $filterLokasiOtmil = $filterData['lokasi_otmil_id'] ?? '';
            $filterLokasiLemasmil = $filterData['lokasi_lemasmil_id'] ?? '';

            $records = [];

            if (!empty($filterLokasiOtmil)) {
                $lokasiOtmil = LokasiOtmil::where('id', $filterLokasiOtmil)->first();
                if ($lokasiOtmil) {
                    $records['lokasi_otmil'] = $lokasiOtmil->nama_lokasi_otmil;
                }
            }

            if (!empty($filterLokasiLemasmil)) {
                $lokasiLemasmil = LokasiLemasmil::where('id', $filterLokasiLemasmil)->first();
                if ($lokasiLemasmil) {
                    $records['lokasi_lemasmil'] = $lokasiLemasmil->nama_lokasi_lemasmil;
                }
            }

            // Initial query to count total WBP
            $queryWBPTotal = DB::table('wbp_profile')
                ->leftJoin('wbp_perkara', 'wbp_perkara.wbp_profile_id', '=', 'wbp_profile.id') // Adjust column name here
                ->leftJoin('lokasi_otmil', 'wbp_perkara.lokasi_otmil_id', '=', 'lokasi_otmil.id') // Adjust column name here
                ->leftJoin('lokasi_lemasmil', 'wbp_perkara.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id');

            // Add filter conditions
            if (!empty($filterLokasiOtmil)) {
                $queryWBPTotal->where('wbp_perkara.lokasi_otmil_id', 'LIKE', '%' . $filterLokasiOtmil . '%');
            }
            if (!empty($filterLokasiLemasmil)) {
                $queryWBPTotal->where('wbp_perkara.lokasi_lemasmil_id', 'LIKE', "%$filterLokasiLemasmil%");
            }

            $totalWBP = $queryWBPTotal->count();

            $records['total_wbp'] = $totalWBP;

            $queryWBPSick = DB::table('wbp_profile')
                ->leftJoin('wbp_perkara', 'wbp_perkara.wbp_profile_id', '=', 'wbp_profile.id') // Adjust column name here
                ->leftJoin('lokasi_otmil', 'wbp_perkara.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                ->leftJoin('lokasi_lemasmil', 'wbp_perkara.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                ->where('wbp_profile.deleted_at')
                ->where('wbp_profile.is_sick', 1);

            if (!empty($filterLokasiOtmil)) {
                $queryWBPSick->where('wbp_perkara.lokasi_otmil_id', 'LIKE', "%$filterLokasiOtmil%");
            }

            if (!empty($filterLokasiLemasmil)) {
                $queryWBPSick->where('wbp_perkara.lokasi_lemasmil_id', 'LIKE', "%$filterLokasiLemasmil%");
            }

            $sickWbpCount = $queryWBPSick->count();
            $records['sick_wbp'] = $sickWbpCount;

            $queryWBPisolated = DB::table('wbp_profile')
                ->leftJoin('wbp_perkara', 'wbp_perkara.wbp_profile_id', '=', 'wbp_profile.id')
                ->leftJoin('lokasi_otmil', 'wbp_perkara.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                ->leftJoin('lokasi_lemasmil', 'wbp_perkara.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                ->where('wbp_profile.deleted_at')
                ->where('wbp_profile.is_sick', 1);

            if (!empty($filterLokasiOtmil)) {
                $queryWBPisolated->where('wbp_perkara.lokasi_otmil_id', 'LIKE', "%{$filterLokasiOtmil}%");
            }

            if (!empty($filterLokasiLemasmil)) {
                $queryWBPisolated->where('wbp_perkara.lokasi_lemasmil_id', 'LIKE', "%{$filterLokasiLemasmil}%");
            }

            $isolatedWbp = $queryWBPisolated->count();
            $records['isolated_wbp'] = $isolatedWbp;

            $queryTotalKamera = Kamera::query()
                ->leftJoin('ruangan_otmil', 'kamera.ruangan_otmil_id', '=', 'ruangan_otmil.id')
                ->leftJoin('ruangan_lemasmil', 'kamera.ruangan_lemasmil_id', '=', 'ruangan_lemasmil.id')
                ->leftJoin('lokasi_otmil', 'ruangan_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                ->leftJoin('lokasi_lemasmil', 'ruangan_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                ->where('kamera.deleted_at');

            if (!empty($filterLokasiOtmil)) {
                $queryTotalKamera->where('lokasi_otmil.id', 'like', "%$filterLokasiOtmil%");
            }

            if (!empty($filterLokasiLemasmil)) {
                $queryTotalKamera->where('lokasi_lemasmil.id', 'like', "%$filterLokasiLemasmil%");
            }

            $totalKamera = $queryTotalKamera->count();
            $records['total_kamera'] = $totalKamera;

            $queryTotalKameraAktif = Kamera::query()
                ->leftJoin('ruangan_otmil', 'kamera.ruangan_otmil_id', '=', 'ruangan_otmil.id')
                ->leftJoin('ruangan_lemasmil', 'kamera.ruangan_lemasmil_id', '=', 'ruangan_lemasmil.id')
                ->leftJoin('lokasi_otmil', 'ruangan_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                ->leftJoin('lokasi_lemasmil', 'ruangan_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                ->where('kamera.deleted_at')
                ->where('kamera.status_kamera', 'online');

            // Add filter conditions
            if (!empty($filterLokasiOtmil)) {
                $queryTotalKameraAktif->where('lokasi_otmil.id', 'LIKE', "%$filterLokasiOtmil%");
            }
            if (!empty($filterLokasiLemasmil)) {
                $queryTotalKameraAktif->where('lokasi_lemasmil.id', 'LIKE', "%$filterLokasiLemasmil%");
            }

            $totalKameraAktif = $queryTotalKameraAktif->count();
            $records['kamera_aktif'] = $totalKameraAktif;

            $queryTotalKameraNonaktif = Kamera::query()
                ->leftJoin('ruangan_otmil', 'kamera.ruangan_otmil_id', '=', 'ruangan_otmil.id')
                ->leftJoin('ruangan_lemasmil', 'kamera.ruangan_lemasmil_id', '=', 'ruangan_lemasmil.id')
                ->leftJoin('lokasi_otmil', 'ruangan_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                ->leftJoin('lokasi_lemasmil', 'ruangan_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                ->where('kamera.deleted_at')
                ->where('kamera.status_kamera', 'offline');

            if (!empty($filterLokasiOtmil)) {
                $queryTotalKameraNonaktif->where('lokasi_otmil.id', 'like', "%$filterLokasiOtmil%");
            }

            if (!empty($filterLokasiLemasmil)) {
                $queryTotalKameraNonaktif->where('lokasi_lemasmil.id', 'like', "%$filterLokasiLemasmil%");
            }

            $totalKameraNonaktif = $queryTotalKameraNonaktif->count();
            $records['kamera_nonaktif'] = $totalKameraNonaktif;

            $queryTotalKameraRusak = Kamera::query()
                ->leftJoin('ruangan_otmil', 'kamera.ruangan_otmil_id', '=', 'ruangan_otmil.id')
                ->leftJoin('ruangan_lemasmil', 'kamera.ruangan_lemasmil_id', '=', 'ruangan_lemasmil.id')
                ->leftJoin('lokasi_otmil', 'ruangan_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                ->leftJoin('lokasi_lemasmil', 'ruangan_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                ->where('kamera.deleted_at')
                ->where('kamera.status_kamera', 'rusak');

            if (!empty($filterLokasiOtmil)) {
                $queryTotalKameraRusak->where('lokasi_otmil.id', 'like', "%$filterLokasiOtmil%");
            }

            if (!empty($filterLokasiLemasmil)) {
                $queryTotalKameraRusak->where('lokasi_lemasmil.id', 'like', "%$filterLokasiLemasmil%");
            }

            $totalKameraRusak = $queryTotalKameraRusak->count();
            $records['kamera_rusak'] = $totalKameraRusak;

            $queryTotalGateway = Gateway::query()
                ->leftJoin('ruangan_otmil', 'gateway.ruangan_otmil_id', '=', 'ruangan_otmil.id')
                ->leftJoin('ruangan_lemasmil', 'gateway.ruangan_lemasmil_id', '=', 'ruangan_lemasmil.id')
                ->leftJoin('lokasi_otmil', 'ruangan_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                ->leftJoin('lokasi_lemasmil', 'ruangan_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                ->where('gateway.deleted_at');

            if (!empty($filterLokasiOtmil)) {
                $queryTotalGateway->where('lokasi_otmil.id', 'LIKE', "%$filterLokasiOtmil%");
            }

            if (!empty($filterLokasiLemasmil)) {
                $queryTotalGateway->where('lokasi_lemasmil.id', 'LIKE', "%$filterLokasiLemasmil%");
            }

            $totalGateway = $queryTotalGateway->count();
            $records['total_gateway'] = $totalGateway;

            $queryTotalGatewayAktif = Gateway::query()
                ->leftJoin('ruangan_otmil', 'gateway.ruangan_otmil_id', '=', 'ruangan_otmil.id')
                ->leftJoin('ruangan_lemasmil', 'gateway.ruangan_lemasmil_id', '=', 'ruangan_lemasmil.id')
                ->leftJoin('lokasi_otmil', 'ruangan_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                ->leftJoin('lokasi_lemasmil', 'ruangan_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                ->where('gateway.deleted_at')
                ->where('gateway.status_gateway', 'aktif');

            if (!empty($filterLokasiOtmil)) {
                $queryTotalGatewayAktif->where('lokasi_otmil.id', 'LIKE', "%$filterLokasiOtmil%");
            }

            if (!empty($filterLokasiLemasmil)) {
                $queryTotalGatewayAktif->where('lokasi_lemasmil.id', 'LIKE', "%$filterLokasiLemasmil%");
            }

            $totalGatewayAktif = $queryTotalGatewayAktif->count();
            $records['gateway_aktif'] = $totalGatewayAktif;

            $queryTotalGatewayNonaktif = Gateway::query()
                ->leftJoin('ruangan_otmil', 'gateway.ruangan_otmil_id', '=', 'ruangan_otmil.id')
                ->leftJoin('ruangan_lemasmil', 'gateway.ruangan_lemasmil_id', '=', 'ruangan_lemasmil.id')
                ->leftJoin('lokasi_otmil', 'ruangan_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                ->leftJoin('lokasi_lemasmil', 'ruangan_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                ->where('gateway.deleted_at')
                ->where('gateway.status_gateway', 'nonaktif');

            if (!empty($filterLokasiOtmil)) {
                $queryTotalGatewayNonaktif->where('lokasi_otmil.id', 'LIKE', "%$filterLokasiOtmil%");
            }

            if (!empty($filterLokasiLemasmil)) {
                $queryTotalGatewayNonaktif->where('lokasi_lemasmil.id', 'LIKE', "%$filterLokasiLemasmil%");
            }

            $totalGatewayNonktif = $queryTotalGatewayNonaktif->count();
            $records['gateway_nonaktif'] = $totalGatewayNonktif;

            $queryTotalGatewayRusak = Gateway::query()
                ->leftJoin('ruangan_otmil', 'gateway.ruangan_otmil_id', '=', 'ruangan_otmil.id')
                ->leftJoin('ruangan_lemasmil', 'gateway.ruangan_lemasmil_id', '=', 'ruangan_lemasmil.id')
                ->leftJoin('lokasi_otmil', 'ruangan_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                ->leftJoin('lokasi_lemasmil', 'ruangan_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                ->where('gateway.deleted_at')
                ->where('gateway.status_gateway', 'rusak');

            if (!empty($filterLokasiOtmil)) {
                $queryTotalGatewayRusak->where('lokasi_otmil.id', 'LIKE', "%$filterLokasiOtmil%");
            }

            if (!empty($filterLokasiLemasmil)) {
                $queryTotalGatewayRusak->where('lokasi_lemasmil.id', 'LIKE', "%$filterLokasiLemasmil%");
            }

            $totalGatewayRusak = $queryTotalGatewayRusak->count();
            $records['gateway_rusak'] = $totalGatewayRusak;

            $queryTotalGelang = Gelang::query()
                ->leftJoin('ruangan_otmil', 'gelang.ruangan_otmil_id', '=', 'ruangan_otmil.id')
                ->leftJoin('ruangan_lemasmil', 'gelang.ruangan_lemasmil_id', '=', 'ruangan_lemasmil.id')
                ->leftJoin('lokasi_otmil', 'ruangan_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                ->leftJoin('lokasi_lemasmil', 'ruangan_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                ->where('gelang.deleted_at');

            if (!empty($filterLokasiOtmil)) {
                $queryTotalGelang->where('lokasi_otmil.id', 'LIKE', "%$filterLokasiOtmil%");
            }
            if (!empty($filterLokasiLemasmil)) {
                $queryTotalGelang->where('lokasi_lemasmil.id', 'LIKE', "%$filterLokasiLemasmil%");
            }

            $totalGelang = $queryTotalGelang->count();
            $records['total_gelang'] = $totalGelang;

            $queryTotalGelangAktif = Gelang::query()
                ->leftJoin('ruangan_otmil', 'gelang.ruangan_otmil_id', '=', 'ruangan_otmil.id')
                ->leftJoin('ruangan_lemasmil', 'gelang.ruangan_lemasmil_id', '=', 'ruangan_lemasmil.id')
                ->leftJoin('lokasi_otmil', 'ruangan_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                ->leftJoin('lokasi_lemasmil', 'ruangan_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                ->where('gelang.deleted_at')
                ->where('gelang.baterai', '>', 20);

            if (!empty($filterLokasiOtmil)) {
                $queryTotalGelangAktif->where('lokasi_otmil.id', 'LIKE', "%$filterLokasiOtmil%");
            }
            if (!empty($filterLokasiLemasmil)) {
                $queryTotalGelangAktif->where('lokasi_lemasmil.id', 'LIKE', "%$filterLokasiLemasmil%");
            }

            $totalGelangAktif = $queryTotalGelangAktif->count();
            $records['gelang_aktif'] = $totalGelangAktif;

            $queryTotalGelangLowPower = Gelang::query()
                ->leftJoin('ruangan_otmil', 'gelang.ruangan_otmil_id', '=', 'ruangan_otmil.id')
                ->leftJoin('ruangan_lemasmil', 'gelang.ruangan_lemasmil_id', '=', 'ruangan_lemasmil.id')
                ->leftJoin('lokasi_otmil', 'ruangan_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                ->leftJoin('lokasi_lemasmil', 'ruangan_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                ->where('gelang.deleted_at')
                ->where('gelang.baterai', '<=', 20);

            if (!empty($filterLokasiOtmil)) {
                $queryTotalGelangLowPower->where('lokasi_otmil.id', 'LIKE', "%$filterLokasiOtmil%");
            }
            if (!empty($filterLokasiLemasmil)) {
                $queryTotalGelangLowPower->where('lokasi_lemasmil.id', 'LIKE', "%$filterLokasiLemasmil%");
            }

            $totalGelangNonaktif = $queryTotalGelangLowPower->count();
            $records['gelang_low_power'] = $totalGelangNonaktif;

            $queryTotalPerkara = DB::table('wbp_perkara')
                ->leftJoin('wbp_profile', 'wbp_perkara.wbp_profile_id', '=', 'wbp_profile.id')
                ->leftJoin('lokasi_otmil', 'wbp_perkara.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                ->leftJoin('lokasi_lemasmil', 'wbp_perkara.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                ->where('wbp_perkara.deleted_at');

            // Add filter conditions
            if (!empty($filterLokasiOtmil)) {
                $queryTotalPerkara->where('lokasi_otmil.id', 'LIKE', "%$filterLokasiOtmil%");
            }
            if (!empty($filterLokasiLemasmil)) {
                $queryTotalPerkara->where('lokasi_lemasmil.id', 'LIKE', "%$filterLokasiLemasmil%");
            }

            $totalperkara = $queryTotalPerkara->count();
            $records['total_perkara'] = $totalperkara;

            $kategoriPerkara = KategoriPerkara::query()
                ->where('kategori_perkara.deleted_at')
                ->get();

            foreach ($kategoriPerkara as $kategori) {
                $kategoriPerkaraId = $kategori->id;

                $queryPerkaraKategoriTotal = DB::table('wbp_perkara')
                    ->leftJoin('wbp_profile', 'wbp_perkara.wbp_profile_id', '=', 'wbp_profile.id')
                    ->leftJoin('lokasi_otmil', 'wbp_perkara.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                    ->leftJoin('lokasi_lemasmil', 'wbp_perkara.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                    ->whereNull('wbp_perkara.deleted_at') // Memperbaiki kondisi where untuk mengecek null deleted_at
                    ->where('wbp_perkara.kategori_perkara_id', $kategoriPerkaraId);

                // Tambahkan kondisi filter
                if (!empty($filterLokasiOtmil)) {
                    $queryPerkaraKategoriTotal->where('lokasi_otmil.id', 'LIKE', "%$filterLokasiOtmil%");
                }
                if (!empty($filterLokasiLemasmil)) {
                    $queryPerkaraKategoriTotal->where('lokasi_lemasmil.id', 'LIKE', "%$filterLokasiLemasmil%");
                }

                $totalPerkara = $queryPerkaraKategoriTotal->count();

                $namaKategoriPerkara = $kategori->nama_kategori_perkara; // Mengambil nama kategori perkara langsung dari objek $kategori

                $records['perkara'][$namaKategoriPerkara] = $totalPerkara;
            }

            return response()->json([
                'status' => 'OK',
                'message' => '',
                'records' => $records
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve data from database',
                'records' => $e->getMessage()
            ], 500);
        }
    }

    public function store(WbpPerkaraRequest $request)
    {
        try {
            $wbpPerkara = new WbpPerkara([
                'kategori_perkara_id' => $request->kategori_perkara_id,
                'jenis_perkara_id' => $request->jenis_perkara_id,
                'vonis_tahun' => $request->vonis_tahun,
                'vonis_bulan' => $request->vonis_bulan,
                'vonis_hari' => $request->vonis_hari,
                'tanggal_ditahan_otmil' => $request->tanggal_ditahan_otmil,
                'tanggal_ditahan_lemasmil' => $request->tanggal_ditahan_lemasmil,
                'lokasi_otmil_id' => $request->lokasi_otmil_id,
                'lokasi_lemasmil_id' => $request->lokasi_lemasmil_id,
                'residivis' => $request->residivis,
                'wbp_profile_id' => $request->wbp_profile_id,
            ]);

            if ($wbpPerkara->save()) {
                return ApiResponse::created($wbpPerkara);
            } else {
                return ApiResponse::error('Failed to create Wbp Perkara.', 'Unknown error.');
            }
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to create Wbp Perkara.', $e->getMessage());
        }
    }
}
