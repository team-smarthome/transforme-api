<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetugasShift;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiResponse;

class RekapJamKerjaLemburController extends Controller
{
  /**
   * Display a listing of the resource.
   */
 public function index()
{
    try {
        $query = DB::table('petugas_shift')
            ->select([
                'petugas_shift.petugas_id',
                'petugas.nrp',
                'petugas.nama',
                DB::raw("STRING_AGG(DISTINCT CAST(petugas_shift.schedule_id AS VARCHAR), ',') AS shift_id"),
                DB::raw("SUM(CASE WHEN petugas_shift.status_kehadiran = 1 THEN 1 ELSE 0 END) AS hadir"),
                DB::raw("STRING_AGG(DISTINCT COALESCE(CAST(petugas_shift.status_pengganti AS VARCHAR), '0'), ',') AS lembur"),
                DB::raw("SUM((CASE WHEN petugas_shift.status_kehadiran = 1 THEN 1 ELSE 0 END + COALESCE(petugas_shift.status_pengganti::integer, 0)) * EXTRACT(EPOCH FROM (shift.waktu_selesai - shift.waktu_mulai)) / 3600) AS total_jamKerja"),
                DB::raw("MIN(schedule.tanggal) AS tanggal"),
                DB::raw("MIN(schedule.bulan) AS bulan"),
                DB::raw("MIN(schedule.tahun) AS tahun"),
            ])
            ->leftJoin('petugas', 'petugas_shift.petugas_id', '=', 'petugas.id')
            ->leftJoin('shift', 'petugas_shift.shift_id', '=', 'shift.id')
            ->leftJoin('schedule', 'petugas_shift.schedule_id', '=', 'schedule.id')
            ->groupBy('petugas_shift.petugas_id', 'petugas.nrp', 'petugas.nama', 'schedule.bulan')
            ->orderByDesc('schedule.bulan')
            ->orderBy('petugas.nama');

        $filterableColumns = [
            'nama' => 'petugas.nama',
            'nrp' => 'petugas.nrp',
            'tanggal' => 'schedule.tanggal',
            'bulan' => 'schedule.bulan',
            'tahun' => 'schedule.tahun',
        ];

        foreach ($filterableColumns as $requestKey => $column) {
            if ($value = request($requestKey)) {
                // Handle specific date filter
                if ($requestKey === 'tanggal' && request('bulan') && request('tahun')) {
                    $query->where('schedule.tanggal', $value)
                          ->where('schedule.bulan', request('bulan'))
                          ->where('schedule.tahun', request('tahun'));
                } else {
                    $query->where($column, 'like', '%' . $value . '%');
                }
            }
        }

        return ApiResponse::paginate($query);
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
