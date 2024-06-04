<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $pageSize = $request->input('pageSize', 10);
    $filterTanggal = $request->input('tanggal', '');
    $filterBulan = $request->input('bulan', '');
    $filterTahun = $request->input('tahun', '');
    $filterNamaShift = $request->input('nama_shift', '');
    $sortField = $request->input('sortBy', 'tanggal');
    $sortOrder = $request->input('sortOrder', 'ASC');

    $query = Schedule::with('shift');

    if (!empty($filterTanggal)) {
      $dateFilter = explode('-', $filterTanggal);

      if (count($dateFilter) == 2) {
        $startDate = (int)$dateFilter[0];
        $endDate = (int)$dateFilter[1];

        if ($startDate > $endDate) {
          [$startDate, $endDate] = [$endDate, $startDate];
        }

        $query->whereBetween('tanggal', [$startDate, $endDate]);
      } elseif (count($dateFilter) == 1) {
        $specificDate = (int)$dateFilter[0];
        $query->where('tanggal', $specificDate);
      }
    }

    if (!empty($filterBulan)) {
      $query->where('bulan', 'LIKE', "%$filterBulan%");
    }
    if (!empty($filterTahun)) {
      $query->where('tahun', 'LIKE', "%$filterTahun%");
    }
    if (!empty($filterNamaShift)) {
      $query->whereHas('shift', function ($q) use ($filterNamaShift) {
        $q->where('nama_shift', 'LIKE', "%$filterNamaShift%");
      });
    }

    $query->orderBy($sortField, $sortOrder);

    return ApiResponse::paginate($query);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ScheduleRequest $request)
  {
    try {
      $newScheduleData = $request->validated();

      // Check if a schedule already exists for the given date
      $existingSchedule = Schedule::where('tanggal', $newScheduleData['tanggal'])
        ->where('bulan', $newScheduleData['bulan'])
        ->where('tahun', $newScheduleData['tahun'])
        ->first();

      if ($existingSchedule) {
        if ($existingSchedule->shift_id !== $newScheduleData['shift_id']) {
          $schedule = Schedule::create($newScheduleData);
          return ApiResponse::created($schedule);
        } else {
          return ApiResponse::error('Schedule already exists for the provided date and shift', 422);
        }
      }
      $schedule = Schedule::create($newScheduleData);
      return ApiResponse::created($schedule);
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
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ScheduleRequest $request)
  {
    try {
      $schedule_id = $request->input('schedule_id');
      $scheduleData = $request->validated();

      $schedule = Schedule::find($schedule_id);
      if (!$schedule) {
        return ApiResponse::error('Schedule not found', 404);
      }

      // Check if the schedule is being updated to a conflicting date, month, year, and shift
      $conflictingSchedule = Schedule::where('tanggal', $scheduleData['tanggal'])
        ->where('bulan', $scheduleData['bulan'])
        ->where('tahun', $scheduleData['tahun'])
        ->where('shift_id', $scheduleData['shift_id'])
        ->where('id', '!=', $schedule_id) // Exclude the current schedule from the check
        ->first();

      if ($conflictingSchedule) {
        return ApiResponse::error('A schedule already exists for the provided date, month, year, and shift', 422);
      }

      // Update the schedule with the new data
      $schedule->update($scheduleData);

      return ApiResponse::updated($schedule);
    } catch (QueryException $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }


  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request)
  {
    try {
      $schedule_id = $request->input('schedule_id');
      $schedule = Schedule::find($schedule_id);
      if (!$schedule) {
        return ApiResponse::error('Schedule not found', 404);
      }
      $schedule->delete();
      return ApiResponse::deleted();
    } catch (QueryException $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }
}
