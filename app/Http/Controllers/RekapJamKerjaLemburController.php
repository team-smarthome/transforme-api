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
            $query = PetugasShift::query()
            ->selectRaw('
                petugas_shift.petugas_id,
                petugas.nrp,
                petugas.nama,
                GROUP_CONCAT(DISTINCT petugas_shift.schedule_id) AS total_jadwal,
                SUM(CASE WHEN petugas_shift.status_kehadiran = 1 THEN 1 ELSE 0 END) AS hadir,
                GROUP_CONCAT(DISTINCT petugas_shift.status_pengganti) AS lembur,
                SUM((CASE WHEN petugas_shift.status_kehadiran = 1 THEN 1 ELSE 0 END + petugas_shift.status_pengganti) * HOUR(TIMEDIFF(ABS(shift.waktu_selesai), ABS(shift.waktu_mulai)))) AS total_jamKerja,
                schedule.bulan
            ')
            ->leftJoin('petugas', 'petugas_shift.petugas_id', '=', 'petugas.id')
            ->leftJoin('shift', 'petugas_shift.shift_id', '=', 'shift.id')
            ->leftJoin('schedule', 'petugas_shift.schedule_id', '=', 'schedule.id')
            ->groupBy('petugas_shift.petugas_id', 'schedule.bulan')
            ->orderBy('schedule.bulan');
            $filterableColumns = [
                'nama' => 'petugas.nama',
                'nrp' => 'petugas.nrp',
                'bulan' => 'schedule.bulan'
            ];
    
            foreach ($filterableColumns as $requestKey => $column) {
                if ($value = request($requestKey)) {
                    $query->where($column, 'like', '%' . $value . '%');
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