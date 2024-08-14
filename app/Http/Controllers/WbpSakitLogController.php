<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\WbpProfile;
use App\Models\WbpSakitLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WbpSakitLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = WbpSakitLog::leftJoin('wbp_profile', 'wbp_profile.id', '=', 'wbp_sakit_log.wbp_profile_id')
                ->leftJoin('hunian_wbp_otmil', 'hunian_wbp_otmil.id', '=', 'wbp_profile.hunian_wbp_otmil_id')
                ->leftJoin('lokasi_otmil', 'lokasi_otmil.id', '=', 'hunian_wbp_otmil.lokasi_otmil_id')
                ->leftJoin('hunian_wbp_lemasmil', 'hunian_wbp_lemasmil.id', '=', 'wbp_profile.hunian_wbp_lemasmil_id')
                ->leftJoin('lokasi_lemasmil', 'lokasi_lemasmil.id', '=', 'hunian_wbp_lemasmil.lokasi_lemasmil_id')
                ->select(
                    DB::raw('GROUP_CONCAT(DISTINCT wbp_sakit_log.wbp_profile_id) AS wbp_sakit'),
                    DB::raw('GROUP_CONCAT(wbp_sakit_log.timestamp) AS waktu_sakit'),
                    DB::raw('GROUP_CONCAT(wbp_sakit_log.keterangan) AS keterangan'),
                    DB::raw('COUNT(DISTINCT CASE WHEN wbp_sakit_log.keterangan LIKE "sakit" THEN wbp_sakit_log.wbp_profile_id ELSE NULL END) AS jumlah_sakit'),
                    DB::raw('COUNT(DISTINCT CASE WHEN wbp_sakit_log.keterangan LIKE "sembuh" THEN wbp_sakit_log.wbp_profile_id ELSE NULL END) AS jumlah_sembuh')
                );

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $record = [];
            $detail_sakit = [];

            foreach ($paginatedData as $row) {
                $record[] = [
                    "jumlah_sakit" => (string)$row->jumlah_sakit,
                    "jumlah_sembuh" => (string)$row->jumlah_sembuh
                ];

                if (isset($row->waktu_sakit) && isset($row->keterangan)) {
                    $per_waktu = explode(',', $row->waktu_sakit);
                    $per_keterangan = explode(',', $row->keterangan);

                    if (count($per_waktu) == 1 && $per_waktu[0] == null)
                        unset($per_waktu[0]);
                    if (count($per_keterangan) == 1 && $per_keterangan[0] == null)
                        unset($per_keterangan[0]);

                    foreach ($per_waktu as $index => $tanggal) {
                        $keterangan = isset($per_keterangan[$index]) ? $per_keterangan[$index] : null;
                        $detail_sakit[] = [
                            "wbp_profile_id" => $row->wbp_sakit,
                            "nama_wbp" => $row->nama,
                            "waktu" => $tanggal,
                            "keterangan" => $keterangan,
                            "lokasi_otmil" => isset($row->lokasi_otmil) ? $row->lokasi_otmil : "",
                            "lokasi_lemasmil" => isset($row->lokasi_lemasmil) ? $row->lokasi_lemasmil : ""
                        ];
                    }
                }
            }

            foreach ($record as &$indeks) {
                $indeks['detail_sakit'] = $detail_sakit;
            };

            return ApiResponse::success($record);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        }
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
