<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\PetugasRequest;
use App\Http\Requests\petugasShiftRequest;
use App\Http\Resources\PetugasShiftResource;
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

  // public function index(Request $request)
  // {
  //   try {
  //     $query = PetugasShift::query()
  //       ->join('shift', 'shift.id', '=', 'petugas_shift.shift_id')
  //       ->join('petugas', 'petugas.id', '=', 'petugas_shift.petugas_id')
  //       ->leftJoin('schedule', 'schedule.id', '=', 'petugas_shift.schedule_id')
  //       ->leftJoin('penugasan', 'penugasan.id', '=', 'petugas_shift.penugasan_id')
  //       ->leftJoin('ruangan_otmil', 'ruangan_otmil.id', '=', 'petugas_shift.ruangan_otmil_id')
  //       ->leftJoin('ruangan_lemasmil', 'ruangan_lemasmil.id', '=', 'petugas_shift.ruangan_lemasmil_id')
  //       ->leftJoin('lokasi_otmil', 'lokasi_otmil.id', '=', 'petugas.lokasi_otmil_id')
  //       ->leftJoin('lokasi_lemasmil', 'lokasi_lemasmil.id', '=', 'petugas.lokasi_lemasmil_id')
  //       ->leftJoin('pangkat', 'petugas.pangkat_id', '=', 'pangkat.id')
  //       ->leftJoin('kesatuan', 'petugas.kesatuan_id', '=', 'kesatuan.id')
  //       ->leftJoin('lokasi_kesatuan', 'kesatuan.lokasi_kesatuan_id', '=', 'lokasi_kesatuan.id')
  //       ->leftJoin('zona as zona_otmil', 'zona_otmil.id', '=', 'ruangan_otmil.zona_id')
  //       ->leftJoin('zona as zona_lemasmil', 'zona_lemasmil.id', '=', 'ruangan_lemasmil.zona_id')
  //       ->leftJoin('grup_petugas', 'petugas.grup_petugas_id', '=', 'grup_petugas.id')
  //       ->select(
  //         'petugas_shift.*',
  //         'shift.nama_shift',
  //         'shift.waktu_mulai',
  //         'shift.waktu_selesai',
  //         'petugas.nama',
  //         'pangkat.nama_pangkat',
  //         'kesatuan.nama_kesatuan',
  //         'lokasi_kesatuan.nama_lokasi_kesatuan',
  //         'petugas.jabatan',
  //         'petugas.divisi',
  //         'petugas.nomor_petugas',
  //         'lokasi_otmil.nama_lokasi_otmil',
  //         'lokasi_lemasmil.nama_lokasi_lemasmil',
  //         'schedule.tanggal',
  //         'schedule.bulan',
  //         'schedule.tahun',
  //         'penugasan.nama_penugasan',
  //         'ruangan_otmil.nama_ruangan_otmil',
  //         'ruangan_otmil.jenis_ruangan_otmil',
  //         'ruangan_lemasmil.nama_ruangan_lemasmil',
  //         'ruangan_lemasmil.jenis_ruangan_lemasmil',
  //         'zona_otmil.nama_zona as status_zona_otmil',
  //         'zona_lemasmil.nama_zona as status_zona_lemasmil',
  //         'grup_petugas.nama_grup_petugas'
  //       )
  //       ->where('petugas_shift.deleted_at', NULL);

  //     $filters = $request->input('filter', []);
  //     $allowedFilters = [
  //       'nama_shift', 'waktu_mulai', 'waktu_selesai', 'nama', 'nama_pangkat', 'nama_kesatuan', 'nama_lokasi_kesatuan', 'jabatan', 'divisi',
  //       'nomor_petugas', 'nama_lokasi_otmil', 'nama_lokasi_lemasmil', 'tanggal', 'bulan', 'tahun', 'status_kehadiran', 'status_izin', 'nama_penugasan', 'ruangan_otmil_id', 'ruangan_lemasmil_id',
  //       'nama_ruangan_otmil', 'jenis_ruangan_otmil', 'nama_ruangan_lemasmil', 'jenis_ruangan_lemasmil', 'grup_petugas_id', 'nama_grup_petugas', 'schedule_id',
  //     ];

  //     foreach ($filters as $key => $value) {
  //       if (in_array($key, $allowedFilters) && !empty($value)) {
  //         $query->where($key, 'like', "%$value%");
  //       }
  //     }

  //     if (!empty($filters['tanggal'])) {
  //       $dateFilter = explode('-', $filters['tanggal']);
  //       if (count($dateFilter) == 2) {
  //         $query->whereBetween('schedule.tanggal', [(int)$dateFilter[0], (int)$dateFilter[1]]);
  //       } else {
  //         $query->where('schedule.tanggal', (int)$dateFilter[0]);
  //       }
  //     }


  //     $sortField = $request->input('sortBy', 'tanggal');


  //     $allowedSortFields = [
  //       'nama_shift', 'waktu_mulai', 'waktu_selesai', 'nama', 'nama_pangkat', 'nama_kesatuan', 'nama_lokasi_kesatuan', 'jabatan', 'divisi',
  //       'nomor_petugas', 'nama_lokasi_otmil', 'nama_lokasi_lemasmil', 'tanggal', 'bulan', 'tahun', 'status_kehadiran', 'status_izin', 'nama_penugasan',
  //       'nama_ruangan_otmil', 'jenis_ruangan_otmil', 'nama_ruangan_lemasmil', 'jenis_ruangan_otmil', 'status_pengganti', 'status_zona_otmil', 'status_zona_lemasmil',
  //       'nama_grup_petugas'
  //     ];
  //     if (!in_array($sortField, $allowedSortFields)) {
  //       $sortField = 'tanggal';
  //     }

  //     $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
  //     $resourceCollection = PetugasShiftResource::collection($paginatedData);
  //     return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
  //   } catch (Exception $e) {
  //     return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
  //   }
  // }

  public function index(Request $request)
  {
    try {
      $query = PetugasShift::query()
        ->join('shift', 'shift.id', '=', 'petugas_shift.shift_id')
        ->join('petugas', 'petugas.id', '=', 'petugas_shift.petugas_id')
        ->leftJoin('schedule', 'schedule.id', '=', 'petugas_shift.schedule_id')
        ->leftJoin('penugasan', 'penugasan.id', '=', 'petugas_shift.penugasan_id')
        ->leftJoin('ruangan_otmil', 'ruangan_otmil.id', '=', 'petugas_shift.ruangan_otmil_id')
        ->leftJoin('ruangan_lemasmil', 'ruangan_lemasmil.id', '=', 'petugas_shift.ruangan_lemasmil_id')
        ->leftJoin('lokasi_otmil', 'lokasi_otmil.id', '=', 'petugas.lokasi_otmil_id')
        ->leftJoin('lokasi_lemasmil', 'lokasi_lemasmil.id', '=', 'petugas.lokasi_lemasmil_id')
        ->leftJoin('pangkat', 'petugas.pangkat_id', '=', 'pangkat.id')
        ->leftJoin('kesatuan', 'petugas.kesatuan_id', '=', 'kesatuan.id')
        ->leftJoin('lokasi_kesatuan', 'kesatuan.lokasi_kesatuan_id', '=', 'lokasi_kesatuan.id')
        ->leftJoin('zona as zona_otmil', 'zona_otmil.id', '=', 'ruangan_otmil.zona_id')
        ->leftJoin('zona as zona_lemasmil', 'zona_lemasmil.id', '=', 'ruangan_lemasmil.zona_id')
        ->leftJoin('grup_petugas', 'petugas.grup_petugas_id', '=', 'grup_petugas.id')
        ->select(
          'petugas_shift.*',
          'shift.nama_shift',
          'shift.waktu_mulai',
          'shift.waktu_selesai',
          'petugas.nama',
          'pangkat.nama_pangkat',
          'kesatuan.nama_kesatuan',
          'lokasi_kesatuan.nama_lokasi_kesatuan',
          'petugas.jabatan',
          'petugas.divisi',
          'petugas.nomor_petugas',
          'lokasi_otmil.nama_lokasi_otmil',
          'lokasi_lemasmil.nama_lokasi_lemasmil',
          'schedule.tanggal',
          'schedule.bulan',
          'schedule.tahun',
          'penugasan.nama_penugasan',
          'ruangan_otmil.nama_ruangan_otmil',
          'ruangan_otmil.jenis_ruangan_otmil',
          'ruangan_lemasmil.nama_ruangan_lemasmil',
          'ruangan_lemasmil.jenis_ruangan_lemasmil',
          'zona_otmil.nama_zona as status_zona_otmil',
          'zona_lemasmil.nama_zona as status_zona_lemasmil',
          'grup_petugas.nama_grup_petugas'
        )
        ->whereNull('petugas_shift.deleted_at'); // Using whereNull instead of where('petugas_shift.deleted_at', NULL)

      $filterableColumns = [
        'petugas_shift_id' => 'petugas_shift.id',
        'schedule_id' => 'petugas_shift.schedule_id',
        'grup_petugas_id' => 'petugas.grup_petugas_id',
        'nama_shift' => 'shift.nama_shift',
        'waktu_mulai' => 'shift.waktu_mulai',
        'waktu_selesai' => 'shift.waktu_selesai',
        'nama' => 'petugas.nama',
        'nama_pangkat' => 'pangkat.nama_pangkat',
        'nama_kesatuan' => 'kesatuan.nama_kesatuan',
        'nama_lokasi_kesatuan' => 'lokasi_kesatuan.nama_lokasi_kesatuan',
        'jabatan' => 'petugas.jabatan',
        'divisi' => 'petugas.divisi',
        'tanggal' => 'schedule.tanggal'
      ];

      foreach ($filterableColumns as $requestKey => $column) {
        if ($request->has($requestKey)) {
          if ($requestKey == 'tanggal') {
            $dateFilter = explode('-', $request->input($requestKey));
            if (count($dateFilter) == 2) {
              $query->whereBetween('schedule.tanggal', [(int)$dateFilter[0], (int)$dateFilter[1]]);
            } else {
              $query->where('schedule.tanggal', (int)$dateFilter[0]);
            }
          } else {
            $query->where($column, 'like', '%' . $request->input($requestKey) . '%');
          }
        }
      }

      $sortField = $request->input('sortBy', 'tanggal');

      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = PetugasShiftResource::collection($paginatedData);
      return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }


  // public function store(petugasShiftRequest $request)
  // {
  //   try {
  //     $petugasShift = PetugasShift::create($request->validated());
  //     return ApiResponse::created($petugasShift);
  //   } catch (QueryException $e) {
  //     return ApiResponse::error('Database error', $e->getMessage(), 500);
  //   } catch (Exception $e) {
  //     return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
  //   }
  // }
  public function store(petugasShiftRequest $request)
  {
    try {
      $data = $request->validated();
      $petugasShifts = [];

      foreach ($data as $item) {
        $petugasShift = PetugasShift::create($item);
        $petugasShifts[] = $petugasShift;
      }

      return ApiResponse::created($petugasShifts);
    } catch (QueryException $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
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




  public function edit(Request $request)
  {
    try {
      $input = $request->input('petugas_shifts');


      if (is_array($input)) {
        $updatedShifts = [];

        foreach ($input as $shiftData) {
          $petugas_shift = PetugasShift::findOrFail($shiftData['petugas_shift_id']);
          $petugas_shift->update($shiftData);
          $petugas_shift->fresh();
          $updatedShifts[] = $petugas_shift;
        }

        return ApiResponse::success('Data updated successfully', $updatedShifts);
      }

      $id = $request->input('petugas_shift_id');
      $petugas_shift = PetugasShift::findOrFail($id);
      $petugas_shift->update($request->all());
      $petugas_shift->fresh();


      return ApiResponse::success('Data updated successfully', $petugas_shift);
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
  // public function destroy(Request $request)
  // {
  //   try {
  //     $id = $request->input('petugas_shift_id');
  //     $petugas_shift = PetugasShift::findOrFail($id);

  //     $petugas_shift->delete();
  //     return ApiResponse::success('Data delete successfully', $petugas_shift);
  //     // return ApiResponse::updated($petugas_shift);
  //   } catch (QueryException $e) {
  //     return ApiResponse::error('Database error', $e->getMessage(), 500);
  //   } catch (Exception $e) {
  //     return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
  //   }
  // }
  public function destroy(Request $request)
  {
    try {
      $ids = $request->input('petugas_shift_id');
      if (is_array($ids)) {
        PetugasShift::whereIn('id', $ids)->delete();
        return ApiResponse::deleted();
      } else {
        return ApiResponse::error('Invalid input format', 'petugas_shift_id should be an array', 400);
      }
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
          'schedule.tanggal',
          DB::raw("SUM(CASE WHEN LOWER(petugas_shift.status_izin) = 'cuti' THEN 1 ELSE 0 END) AS cuti"),
          DB::raw("SUM(CASE WHEN LOWER(petugas_shift.status_izin) = 'sakit' THEN 1 ELSE 0 END) AS sakit"),
          DB::raw("SUM(CASE WHEN LOWER(petugas_shift.status_izin) = 'izin' THEN 1 ELSE 0 END) AS izin"),
          DB::raw("SUM(CASE WHEN LOWER(petugas_shift.status_izin) = 'absen' THEN 1 ELSE 0 END) AS absen"),
          DB::raw("SUM(CASE WHEN petugas_shift.status_kehadiran = 1 THEN 1 ELSE 0 END) AS hadir"),
          DB::raw("STRING_AGG(DISTINCT CASE WHEN petugas_shift.status_kehadiran = 0 AND LOWER(petugas_shift.status_izin) = 'cuti' THEN petugas.id::text ELSE NULL END, ',') AS petugas_cuti"),
          DB::raw("STRING_AGG(DISTINCT CASE WHEN petugas_shift.status_kehadiran = 0 AND LOWER(petugas_shift.status_izin) = 'sakit' THEN petugas.id::text ELSE NULL END, ',') AS petugas_sakit"),
          DB::raw("STRING_AGG(DISTINCT CASE WHEN petugas_shift.status_kehadiran = 0 AND LOWER(petugas_shift.status_izin) = 'izin' THEN petugas.id::text ELSE NULL END, ',') AS petugas_izin"),
          DB::raw("STRING_AGG(DISTINCT CASE WHEN petugas_shift.status_kehadiran = 0 AND LOWER(petugas_shift.status_izin) = 'absen' THEN petugas.id::text ELSE NULL END, ',') AS petugas_absen"),
          DB::raw("STRING_AGG(DISTINCT CASE WHEN petugas_shift.status_kehadiran = 1 THEN petugas.id::text ELSE NULL END, ',') AS petugas_hadir")
        );

      $filterableColumns = [
        'bulan' => 'schedule.bulan',
        'tahun' => 'schedule.tahun',
        'tanggal' => 'schedule.tanggal'
      ];

      foreach ($filterableColumns as $requestKey => $column) {
        if ($request->has($requestKey)) {
          $query->where($column, 'like', '%' . $request->input($requestKey) . '%');
        }
      }

      // Filter tanggal

      $query->orderBy('schedule.tahun', 'desc')
        ->orderBy('schedule.bulan', 'desc');

      $result = $query->groupBy('schedule.bulan', 'schedule.tahun', 'schedule.tanggal')->get();

      $formattedResult = $result->map(function ($item) {
        return [
          'bulan' => (string)$item->bulan,
          'tahun' => (string)$item->tahun,
          'tanggal' => (string)$item->tanggal,
          'cuti' => (string)$item->cuti,
          'sakit' => (string)$item->sakit,
          'izin' => (string)$item->izin,
          'absen' => (string)$item->absen,
          'hadir' => (string)$item->hadir,
          'petugas_cuti' => !empty($item->petugas_cuti) ? explode(',', $item->petugas_cuti) : [],
          'petugas_sakit' => !empty($item->petugas_sakit) ? explode(',', $item->petugas_sakit) : [],
          'petugas_izin' => !empty($item->petugas_izin) ? explode(',', $item->petugas_izin) : [],
          'petugas_absen' => !empty($item->petugas_absen) ? explode(',', $item->petugas_absen) : [],
          'petugas_hadir' => !empty($item->petugas_hadir) ? explode(',', $item->petugas_hadir) : [],
        ];
      });

      return ApiResponse::success($formattedResult);
    } catch (\Exception $e) {
      return ApiResponse::error('Failed to get Data.', $e->getMessage());
    }
  }



  // public function rekapCuti(Request $request)
  // {
  //   try {
  //     $query = PetugasShift::leftJoin('schedule', 'petugas_shift.schedule_id', '=', 'schedule.id')
  //       ->leftJoin('petugas', 'petugas_shift.petugas_id', '=', 'petugas.id')
  //       ->select(
  //         'schedule.tahun',
  //         'schedule.bulan',
  //         'schedule.tanggal',
  //         DB::raw("SUM(CASE WHEN LOWER(petugas_shift.status_izin) = 'cuti' THEN 1 ELSE 0 END) AS cuti"),
  //         DB::raw("STRING_AGG(DISTINCT CASE WHEN petugas_shift.status_kehadiran = 0 AND LOWER(petugas_shift.status_izin) = 'cuti' THEN petugas.id::text ELSE NULL END, ',') AS petugas_cuti"),
  //         DB::raw("JSON_AGG(json_build_object('petugas_id', petugas.id, 'cuti', CASE WHEN petugas_shift.status_izin = 'cuti' THEN 1 ELSE 0 END)) AS detail_cuti")
  //       );

  //     $filterableColumns = [
  //       'bulan' => 'schedule.bulan',
  //       'tahun' => 'schedule.tahun',
  //       'tanggal' => 'schedule.tanggal',
  //     ];

  //     foreach ($filterableColumns as $requestKey => $column) {
  //       if ($request->has($requestKey)) {
  //         $query->where($column, 'like', '%' . $request->input($requestKey) . '%');
  //       }
  //     }

  //     // Filter tanggal

  //     $query->orderBy('schedule.tahun', 'desc')
  //       ->orderBy('schedule.bulan', 'desc');

  //     $result = $query->groupBy('schedule.tahun', 'schedule.bulan',  'schedule.tanggal')->get();

  //     $formattedResult = $result->map(function ($item) {
  //       $petugasCutiArray = !empty($item->petugas_cuti) ? explode(',', $item->petugas_cuti) : [];
  //       return [
  //         'bulan' => (string)$item->bulan,
  //         'tahun' => (string)$item->tahun,
  //         'tanggal' => (string)$item->tanggal,
  //         'cuti' => (string)$item->cuti,
  //         'detail_cuti' => json_decode($item->detail_cuti, true),
  //         'petugas_cuti' => $petugasCutiArray
  //       ];
  //     });

  //     return ApiResponse::success($formattedResult);
  //   } catch (\Exception $e) {
  //     return ApiResponse::error('Failed to get Data.', $e->getMessage());
  //   }
  // }





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
