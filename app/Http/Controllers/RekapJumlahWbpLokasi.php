<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use Exception;
use App\Models\WbpProfile;
use Illuminate\Support\Facades\DB;



class RekapJumlahWbpLokasi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = WbpProfile::select(
                'lokasi_otmil.nama_lokasi_otmil AS lokasi_otmil',
                'lokasi_lemasmil.nama_lokasi_lemasmil AS lokasi_lemasmil',
                DB::raw('COUNT(wbp_profile.id) AS total_wbp'),
                DB::raw('GROUP_CONCAT(DISTINCT wbp_profile.nama) AS nama_wbp'),
                DB::raw('SUM(CASE WHEN matra.nama_matra = "TNI Angkatan Darat" THEN 1 ELSE 0 END) AS total_angkatan_darat'),
                DB::raw('SUM(CASE WHEN matra.nama_matra = "TNI Angkatan Laut" THEN 1 ELSE 0 END) AS total_angkatan_laut'),
                DB::raw('SUM(CASE WHEN matra.nama_matra = "TNI Angkatan Udara" THEN 1 ELSE 0 END) AS total_angkatan_udara')
            )
                ->leftJoin('hunian_wbp_otmil', 'wbp_profile.hunian_wbp_otmil_id', '=', 'hunian_wbp_otmil.id')
                ->leftJoin('lokasi_otmil', 'hunian_wbp_otmil.lokasi_otmil_id', '=', 'lokasi_otmil.id')
                ->leftJoin('hunian_wbp_lemasmil', 'wbp_profile.hunian_wbp_lemasmil_id', '=', 'hunian_wbp_lemasmil.id')
                ->leftJoin('lokasi_lemasmil', 'hunian_wbp_lemasmil.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.id')
                ->leftJoin('matra', 'wbp_profile.matra_id', '=', 'matra.id')
                ->groupBy('lokasi_otmil.nama_lokasi_otmil', 'lokasi_lemasmil.nama_lokasi_lemasmil');

            $filters = $request->input('filter', []);
            if (!empty($filters['lokasi_otmil'])) {
                $query->where('lokasi_otmil.nama_lokasi_otmil', 'like', '%' . $filters['lokasi_otmil'] . '%');
            }
            if (!empty($filters['lokasi_lemasmil'])) {
                $query->where('lokasi_lemasmil.nama_lokasi_lemasmil', 'like', '%' . $filters['lokasi_lemasmil'] . '%');
            }
            if (!empty($filters['nama_wbp'])) {
                $query->where('wbp_profile.nama', 'like', '%' . $filters['nama_wbp'] . '%');
            }

            $result = $query->get();

            $groupedResults = [];
            foreach ($result as $row) {
                if (!empty($row->lokasi_otmil)) {
                    if (!isset($groupedResults[$row->lokasi_otmil])) {
                        $groupedResults[$row->lokasi_otmil] = [
                            "tipe_lokasi" => 'otmil',
                            "nama_lokasi" => $row->lokasi_otmil,
                            "total_wbp" => 0,
                            "nama_wbp" => [],
                            "total_angkatan_darat" => 0,
                            "total_angkatan_laut" => 0,
                            "total_angkatan_udara" => 0,
                        ];
                    }

                    $groupedResults[$row->lokasi_otmil]['total_wbp'] += $row->total_wbp;
                    $groupedResults[$row->lokasi_otmil]['nama_wbp'] = array_merge($groupedResults[$row->lokasi_otmil]['nama_wbp'], explode(',', $row->nama_wbp));
                    $groupedResults[$row->lokasi_otmil]['total_angkatan_darat'] += $row->total_angkatan_darat;
                    $groupedResults[$row->lokasi_otmil]['total_angkatan_laut'] += $row->total_angkatan_laut;
                    $groupedResults[$row->lokasi_otmil]['total_angkatan_udara'] += $row->total_angkatan_udara;
                }

                if (!empty($row->lokasi_lemasmil)) {
                    if (!isset($groupedResults[$row->lokasi_lemasmil])) {
                        $groupedResults[$row->lokasi_lemasmil] = [
                            "tipe_lokasi" => 'lemasmil',
                            "nama_lokasi" => $row->lokasi_lemasmil,
                            "total_wbp" => 0,
                            "nama_wbp" => [],
                            "total_angkatan_darat" => 0,
                            "total_angkatan_laut" => 0,
                            "total_angkatan_udara" => 0,
                        ];
                    }

                    $groupedResults[$row->lokasi_lemasmil]['total_wbp'] += $row->total_wbp;
                    $groupedResults[$row->lokasi_lemasmil]['nama_wbp'] = array_merge($groupedResults[$row->lokasi_lemasmil]['nama_wbp'], explode(',', $row->nama_wbp));
                    $groupedResults[$row->lokasi_lemasmil]['total_angkatan_darat'] += $row->total_angkatan_darat;
                    $groupedResults[$row->lokasi_lemasmil]['total_angkatan_laut'] += $row->total_angkatan_laut;
                    $groupedResults[$row->lokasi_lemasmil]['total_angkatan_udara'] += $row->total_angkatan_udara;
                }
            }

            $formattedResults = [];
            foreach ($groupedResults as $lokasi => $result) {
                // Menghapus duplikat dan menggabungkan nama WBP menjadi satu string yang dipisahkan koma
                $result['nama_wbp'] = implode(',', array_unique($result['nama_wbp']));

                // Menambahkan hasil ke dalam array formattedResults
                $formattedResults[] = $result;
            }

            return ApiResponse::success($formattedResults);
        } catch (Exception $e) {
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
