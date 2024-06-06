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
      $query = Penugasan::query();
      $filterableColumns = [
        'penugasan_id' => 'id',
        'nama_penugasan' => 'nama_penugasan',
      ];
      $filters = $request->input('filter', []);
      foreach ($filterableColumns as $requestKey => $column) {
        if (isset($filters[$requestKey])) {
          $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
        }
      }
      $query->latest();
      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = PenugasanResource::collection($paginatedData);
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
      $id = $request->input('id');
      $penugasan = Penugasan::findOrFail($id);
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
      $id = $request->input('id');
      $penugasan = Penugasan::findOrFail($id);
      $penugasan->delete();
      return ApiResponse::deleted();
    } catch (QueryException $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }
}
