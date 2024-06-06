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

class petugasShiftController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    try {
      $query = PetugasShift::with([
        'shift', 'petugas', 'schedule', 'penugasan',
        'ruangan_otmil', 'ruangan_lemasmil',
        'lokasi_otmil', 'lokasi_lemasmil'
      ]);

      $filterableColumns = [
        'petugas_shift_id' => 'id',
        'petugas_id' => 'petugas.petugas_id',
        'shift_id' => 'shift.shift_id',
        'nama_shift' => 'shift.nama_shift',
        'schedule_id' => 'schedule_id',
        'penugasan_id' => 'penugasan_id',
        'ruangan_otmil_id' => 'ruangan_otmil_id',
        'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
        'lokasi_otmil_id' => 'lokasi_otmil_id',
        'lokasi_lemasmil_id' => 'lokasi_lemasmil_id',
        'waktu_mulai' => 'waktu_mulai',
        'waktu_selesai' => 'waktu_selesai',
      ];

      // Filters related to the schedule table
      $scheduleFilters = [
        'tanggal' => 'schedule.tanggal',
        'bulan' => 'schedule.bulan',
        'tahun' => 'schedule.tahun',
      ];

      $filters = $request->input('filter', []);

      // Apply filters for columns in PetugasShift
      foreach ($filterableColumns as $requestKey => $column) {
        if (isset($filters[$requestKey])) {
          $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
        }
      }

      // Join with the schedule table
      $query->join('schedule', 'petugas_shift.schedule_id', '=', 'schedule.id');

      // Apply filters for columns in the schedule table
      foreach ($scheduleFilters as $requestKey => $column) {
        if (isset($filters[$requestKey])) {
          $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
        }
      }

      $query->orderBy('schedule.created_at', 'desc');
      if (isset($filters['tanggal']) && isset($filters['bulan']) && isset($filters['tahun'])) {
        $query->where(function ($query) use ($filters) {
          $query->where('schedule.tanggal', $filters['tanggal'])
            ->where('schedule.bulan', $filters['bulan'])
            ->where('schedule.tahun', $filters['tahun']);
        });
      }

      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = PetugasShiftResource::collection($paginatedData);

      return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
    } catch (\Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }

  // public function index(Request $request)
  // {
  //   try {

  //     $filters = $request->input('filter', []);


  //     $query = PetugasShift::with(['shift', 'petugas', 'schedule', 'penugasan', 'ruangan_otmil', 'ruangan_lemasmil', 'lokasi_otmil', 'lokasi_lemasmil'])
  //       ->whereNull('deleted_at');


  //     foreach ($filters as $key => $value) {
  //       if ($key === 'tanggal') {
  //         $dateFilter = explode('-', $value);
  //         if (count($dateFilter) === 2) {
  //           $startDate = (int)$dateFilter[0];
  //           $endDate = (int)$dateFilter[1];
  //           $query->whereBetween('tanggal', [$startDate, $endDate]);
  //         } elseif (count($dateFilter) === 1) {
  //           $query->where('tanggal', $value);
  //         }
  //       } else {
  //         $query->where($key, 'like', "%$value%");
  //       }
  //     }


  //     $records = $query->get();

  //     return ApiResponse::success('Data retrieved successfully', $records);
  //   } catch (\Exception $e) {
  //     return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
  //   }
  // }

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
}
