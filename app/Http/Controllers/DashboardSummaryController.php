<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LokasiOtmil;
use App\Models\LokasiLemasmil;

class DashboardSummaryController extends Controller
{
    public function index(Request $request){
        try {
            $filterData = $request->input('filter', []);

            $filterLokasiOtmil = $filterData['lokasi_otmil_id'] ?? '';
            $filterLokasiLemasmil = $filterData['lokasi_lemasmil_id'] ?? '';

            $records = [];

            if (!empty($filterLokasiOtmil)) {
                $lokasiOtmil = LokasiOtmil::where('lokasi_otmil_id', $filterLokasiOtmil)->first();
                if ($lokasiOtmil) {
                    $records['lokasi_otmil'] = $lokasiOtmil->nama_lokasi_otmil;
                }
            }

            if (!empty($filterLokasiLemasmil)) {
                $lokasiLemasmil = LokasiLemasmil::where('lokasi_lemasmil_id', $filterLokasiLemasmil)->first();
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
                $queryWBPTotal->where('wbp_perkara.lokasi_lemasmil_id', 'LIKE', '%' . $filterLokasiLemasmil . '%');
            }

            $totalWBP = $queryWBPTotal->count();

            $records['total_wbp'] = $totalWBP;

            $queryWBPSick = DB::table('wbp_profile')
            ->leftJoin('wbp_perkara', 'wbp_perkara.wbp_profile_id', '=', 'wbp_profile.id') // Adjust column name here
            ->leftJoin('lokasi_otmil', 'wbp_perkara.lokasi_otmil_id', '=', 'lokasi_otmil.lokasi_otmil_id')
            ->leftJoin('lokasi_lemasmil', 'wbp_perkara.lokasi_lemasmil_id', '=', 'lokasi_lemasmil.lokasi_lemasmil_id')
            ->where('wbp_profile.is_deleted', 0)
            ->where('wbp_profile.is_sick', 1);

            if (!empty($filterLokasiOtmil)) {
                $queryWBPSick->where('wbp_perkara.lokasi_otmil_id', 'LIKE', "%$filterLokasiOtmil%");
            }

            if (!empty($filterLokasiLemasmil)) {
                $queryWBPSick->where('wbp_perkara.lokasi_lemasmil_id', 'LIKE', "%$filterLokasiLemasmil%");
            }

            $sickWbpCount = $queryWBPSick->count();

            $records['sick_wbp'] = $sickWbpCount;

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
}
