<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\HelmetRequest;
use App\Http\Resources\HelmetResource;
use App\Models\Helmet;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class HelmetController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = Helmet::query();
      $filterableColumns = [
        'helmet_id' => 'id',
        'dmac' => 'dmac',
        'nama_helmet' => 'nama_helmet',
        'tanggal_pasang' => 'tanggal_pasang',
        'tanggal_aktivasi' => 'tanggal_aktivasi',
        'ruangan_otmil_id' => 'ruangan_otmil_id',
        'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
        'nama_ruangan_lemasmil' => 'nama_ruangan_lemasmil',
        'baterai' => 'baterai'
      ];
      foreach ($filterableColumns as $requestKey => $column) {
        if ($request->has($requestKey)) {
          $query->where($column, 'ilike', '%' . $request->input($requestKey) . '%');
        }
      }

      $query->latest();
      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

      $resourceCollection = HelmetResource::collection($paginatedData);

      return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
    } catch (\Exception $e) {
      return ApiResponse::error('Failed to get data.', $e->getMessage());
    }
  }

  public function store(HelmetRequest $request)
  {
    try {
      $helmet = Helmet::create($request->validated());

      return ApiResponse::created($helmet);
    } catch (QueryException $e) {
      // Menangani kesalahan query database, seperti pelanggaran constraint unik
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
      // Menangani semua kesalahan lain yang tidak terduga
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }

  public function update(Request $request)
  {
    try {
      $helmet_id = $request->input('helmet_id');
      $gelang = Helmet::findOrFail($helmet_id);

      $existingHelmet = Helmet::where('nama_helmet', $gelang->nama_helmet)->first();

      if ($existingHelmet && $existingHelmet->id !== $helmet_id) {
        return ApiResponse::error('Helmet sudah ada', 500);
      }
      $gelang->update($request->all());
      return ApiResponse::updated($gelang);
    } catch (ModelNotFoundException $e) {
      return ApiResponse::error('Helmet not found', 404);
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    } catch (QueryException $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    }
  }

  public function destroy(Request $request)
  {
    try {
      $helmet_id = $request->input('helmet_id');
      $gelang = Helmet::findOrFail($helmet_id);
      $gelang->delete();
      return ApiResponse::deleted();
    } catch (QueryException $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }
}
