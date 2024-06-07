<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\PetugasRequest;
use App\Http\Requests\petugasShiftRequest;
use App\Models\PetugasShift;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class petugasShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $filters = $request->input('filter', []);


            $query = PetugasShift::with(['shift', 'petugas', 'schedule', 'penugasan', 'ruangan_otmil', 'ruangan_lemasmil', 'lokasi_otmil', 'lokasi_lemasmil'])
                ->whereNull('deleted_at');


            foreach ($filters as $key => $value) {
                if ($key === 'tanggal') {
                    $dateFilter = explode('-', $value);
                    if (count($dateFilter) === 2) {
                        $startDate = (int)$dateFilter[0];
                        $endDate = (int)$dateFilter[1];
                        $query->whereBetween('tanggal', [$startDate, $endDate]);
                    } elseif (count($dateFilter) === 1) {
                        $query->where('tanggal', $value);
                    }
                } else {
                    $query->where($key, 'like', "%$value%");
                }
            }


            $records = $query->get();

            return ApiResponse::success('Data retrieved successfully', $records);
        } catch (\Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
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

    public function store(petugasShiftRequest $request)
    {
        try {
            $petugasShift = PetugasShift::create($request->validated());
            return ApiResponse::created($petugasShift);
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
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
    public function edit(petugasShiftRequest $request)
    {
        try {
            $id = $request->input('id');
            $petugas_shift = PetugasShift::findOrFail($id);
            $data = $request->validated();

            $petugas_shift->update($data);
            return ApiResponse::success('Data updated successfully', $petugas_shift);
            return ApiResponse::updated($petugas_shift);
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
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
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('id');
            $petugas_shift = PetugasShift::findOrFail($id);

            $petugas_shift->delete();
            return ApiResponse::success('Data delete successfully', $petugas_shift);
            // return ApiResponse::updated($petugas_shift);
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
    }

    public function rekapCuti(Request $request)
    {
        try {
            $query = PetugasShift::leftJoin('schedule', 'petugas_shift.schedule_id', '=', 'schedule.id')
                ->leftJoin('petugas', 'petugas_shift.petugas_id', '=', 'petugas.id')
                ->select(
                    'schedule.bulan',
                    'schedule.tahun',
                    DB::raw('SUM(CASE WHEN petugas_shift.status_izin = "cuti" THEN 1 ELSE 0 END) AS cuti'),
                    DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN petugas_shift.status_kehadiran = 0 AND petugas_shift.status_izin LIKE "Cuti" THEN petugas.id ELSE NULL END) AS petugas_cuti')
                );

            $filters = $request->input('filter', []);
            if (!empty($filters['bulan'])) {
                $query->where('schedule.bulan', $filters['bulan']);
            }
            if (!empty($filters['tahun'])) {
                $query->where('schedule.tahun', $filters['tahun']);
            }

            $query->orderBy('schedule.tahun', 'desc')->orderBy('schedule.bulan', 'desc');

            $result = $query->groupBy('schedule.bulan', 'schedule.tahun')->get();

            $formattedResult = $result->map(function ($item) {
                $petugasCutiArray = !empty($item->petugas_cuti) ? explode(',', $item->petugas_cuti) : [];
                return [
                    'bulan' => (string)$item->bulan,
                    'tahun' => (string)$item->tahun,
                    'cuti' => (string)$item->cuti,
                    'petugas_cuti' => $petugasCutiArray
                ];
            });

            return ApiResponse::success($formattedResult);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        }
    }


    public function rekapAbsensi(Request $request)
    {
        try {
            $query = PetugasShift::leftJoin('schedule', 'petugas_shift.schedule_id', '=', 'schedule.id')
                ->leftJoin('petugas', 'petugas_shift.petugas_id', '=', 'petugas.id')
                ->select(
                    'schedule.tanggal',
                    'schedule.bulan',
                    'schedule.tahun',
                    DB::raw('COUNT(DISTINCT petugas_shift.petugas_id) AS total_petugas'),
                    DB::raw('SUM(CASE WHEN petugas_shift.status_kehadiran = 1 THEN 1 ELSE 0 END) AS hadir'),
                    DB::raw('SUM(CASE WHEN petugas_shift.status_izin LIKE "Izin" THEN 1 ELSE 0 END) AS izin'),
                    DB::raw('SUM(CASE WHEN petugas_shift.status_izin LIKE "Sakit" THEN 1 ELSE 0 END) AS sakit'),
                    DB::raw('SUM(CASE WHEN petugas_shift.status_izin LIKE "Absen" THEN 1 ELSE 0 END) AS absen'),
                    DB::raw('SUM(CASE WHEN petugas_shift.status_izin LIKE "Cuti" THEN 1 ELSE 0 END) AS cuti'),
                    DB::raw('GROUP_CONCAT(CASE WHEN petugas_shift.status_kehadiran = 1 THEN petugas.nama ELSE NULL END) AS list_petugas_hadir'),
                    DB::raw('GROUP_CONCAT(CASE WHEN petugas_shift.status_kehadiran = 0 AND petugas_shift.status_izin LIKE "Izin" THEN petugas.nama ELSE NULL END) AS list_petugas_izin'),
                    DB::raw('GROUP_CONCAT(CASE WHEN petugas_shift.status_kehadiran = 0 AND petugas_shift.status_izin LIKE "Sakit" THEN petugas.nama ELSE NULL END) AS list_petugas_sakit'),
                    DB::raw('GROUP_CONCAT(CASE WHEN petugas_shift.status_kehadiran = 0 AND petugas_shift.status_izin = NULL THEN petugas.nama ELSE NULL END) AS list_petugas_alpha'),
                    DB::raw('GROUP_CONCAT(CASE WHEN petugas_shift.status_kehadiran = 0 AND petugas_shift.status_izin LIKE "Cuti" THEN petugas.nama ELSE NULL END) AS list_petugas_cuti')
                );

            $filters = $request->input('filter', []);

            if (!empty($filters['tanggal'])) {
                $query->where('schedule.tanggal', $filters['tanggal']);
            }
            if (!empty($filters['bulan'])) {
                $query->where('schedule.bulan', $filters['bulan']);
            }
            if (!empty($filters['tahun'])) {
                $query->where('schedule.tahun', $filters['tahun']);
            }

            $query->orderBy('schedule.bulan', 'desc');
            $result = $query->groupBy('schedule.tanggal', 'schedule.bulan', 'schedule.tahun')->get();


            $result->map(function ($item) {
                $presentPetugas = [];
                $izinPetugas = [];
                $sakitPetugas = [];
                $alphaPetugas = [];
                $alphaCuti = [];

                if (!empty($item->list_petugas_hadir)) {
                    $listPetugasHadir = explode(',', $item->list_petugas_hadir);
                    $uniquePetugasHadir = array_unique($listPetugasHadir);

                    foreach ($uniquePetugasHadir as $namaPetugas) {
                        $presentPetugas[] = [
                            "nama_petugas" => $namaPetugas,
                        ];
                    }
                }
                if (!empty($item->list_petugas_izin)) {
                    $listPetugasIzin = explode(',', $item->list_petugas_izin);
                    $uniquePetugasIzn = array_unique($listPetugasIzin);

                    foreach ($uniquePetugasIzn as $namaPetugas) {
                        $izinPetugas[] = [
                            "nama_petugas" => $namaPetugas,
                        ];
                    }
                }
                if (!empty($item->list_petugas_sakit)) {
                    $listPetugasSakit = explode(',', $item->list_petugas_sakit);
                    $uniquePetugasSakit = array_unique($listPetugasSakit);

                    foreach ($uniquePetugasSakit as $namaPetugas) {
                        $sakitPetugas[] = [
                            "nama_petugas" => $namaPetugas,
                        ];
                    }
                }
                if (!empty($item->list_petugas_alpha)) {
                    $listPetugasAlpha = explode(',', $item->list_petugas_alpha);
                    $uniquePetugasAlpha = array_unique($listPetugasAlpha);

                    foreach ($uniquePetugasAlpha as $namaPetugas) {
                        $alphaPetugas[] = [
                            "nama_petugas" => $namaPetugas,
                        ];
                    }
                }
                if (!empty($item->list_petugas_cuti)) {
                    $listPetugasCuti = explode(',', $item->list_petugas_cuti);
                    $uniquePetugasCuti = array_unique($listPetugasCuti);

                    foreach ($uniquePetugasCuti as $namaPetugas) {
                        $alphaCuti[] = [
                            "nama_petugas" => $namaPetugas,
                        ];
                    }
                }

                return [
                    'tanggal' => (string)$item->tanggal,
                    'bulan' => (string)$item->bulan,
                    'tahun' => (string)$item->tahun,
                    'total_petugas' => (string)$item->total_petugas,
                    'hadir' => $item->hadir,
                    'izin' => $item->izin,
                    'sakit' => $item->sakit,
                    'absen' => $item->absen,
                    'cuti' => $item->cuti,
                    'list_petugas_hadir' => $presentPetugas,
                    'list_petugas_izin' => $izinPetugas,
                    'list_petugas_sakit' => $sakitPetugas,
                    'list_petugas_alpha' => $alphaPetugas,
                    'list_petugas_cuti' => $alphaCuti,
                ];
            });


            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            return ApiResponse::pagination($paginatedData, 'Successfully get Data');
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        }
    }
}
