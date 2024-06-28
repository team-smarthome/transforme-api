<?php

namespace App\Http\Controllers;

use App\Http\Resources\GedungOtmilResource;
use Illuminate\Http\Request;
use App\Models\GedungOtmil;

class KameraReadByLocationControoler extends Controller
{
  public function index(Request $request)
  {
    try {
      $lokasiOtmilId = $request->input('lokasi_otmil_id');
      // $namaLokasiOtmil = $request->input('nama_lokasi_otmil');

      if (empty($lokasiOtmilId)) {
        return response()->json([
          'status' => 'ERROR',
          'message' => 'lokasi_otmil_id or nama_lokasi_otmil is required',
          'records' => ''
        ], 400);
      }

      $query = GedungOtmil::query();

      if (!empty($lokasiOtmilId)) {
        $query->where('lokasi_otmil_id', $lokasiOtmilId);
      }

      $buildings = $query->with(['lantaiOtmil.ruanganOtmil.kamera'])->get();

      return response()->json([
        'status' => 'OK',
        'message' => '',
        'lokasi' => [
          'lokasi_otmil_id' => $lokasiOtmilId,
          // 'nama_lokasi_otmil' => $namaLokasiOtmil
        ],
        'records' => [
          'gedung' => GedungOtmilResource::collection($buildings)
        ]
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'ERROR',
        'message' => 'Failed to retrieve data from database',
        'records' => $e->getMessage()
      ], 500);
    }
  }
}
