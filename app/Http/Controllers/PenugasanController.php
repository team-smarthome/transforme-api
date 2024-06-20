<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\penugasanRequest;
use App\Http\Resources\PenugasanResource;
use App\Models\Penugasan;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PenugasanController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    try {

      $nama_penugasan = $request->input('nama_penugasan');
      $penugasan_id = $request->input('penugasan_id');
      $pageSize = $request->input('pageSize', ApiResponse::$defaultPagination);
      $query = Penugasan::with(['petugas_shift'])
        ->where('id', 'like', '%' . $penugasan_id . '%')
        ->where('nama_penugasan', 'like', '%' . $nama_penugasan . '%')
        ->latest()->paginate($pageSize);


      $resourceCollection = PenugasanResource::collection($query);
      return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
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
  public function store(penugasanRequest $request)
  {
    try {
      $penugasan = Penugasan::create($request->validated());
      return ApiResponse::created($penugasan);
    } catch (\Exception $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
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
  public function edit(PenugasanRequest $request)
  {
    try {
      $penugasan_id = $request->input('penugasan_id');
      $penugasan = Penugasan::findOrFail($penugasan_id);
      $data = $request->validated();
      $penugasan->update($data);
      return ApiResponse::success('Data updated successfully', $penugasan);
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
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request)
  {
    try {
      $penugasan_id = $request->input('penugasan_id');
      $penugasan = Penugasan::findOrFail($penugasan_id);
      $penugasan->delete();
      return ApiResponse::deleted();
    } catch (QueryException $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }
}
