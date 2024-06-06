<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gelang;
use App\Helpers\ApiResponse;
use App\Http\Requests\GelangRequest;
use App\Http\Resources\GelangResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class GelangController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = Gelang::query();
      $filterableColumns = [
        'gelang_id' => 'id',
        'dmac' => 'dmac',
        'nama_gelang' => 'nama_gelang',
        'tanggal_pasang' => 'tanggal_pasang',
        'tanggal_aktivasi' => 'tanggal_aktivasi',
        'ruangan_otmil_id' => 'ruangan_otmil_id',
        'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
        'nama_ruangan_lemasmil' => 'nama_ruangan_lemasmil',
        'baterai' => 'baterai'
      ];
      $filters = $request->input('filter', []);

      foreach ($filterableColumns as $requestKey => $column) {
        if (isset($filters[$requestKey])) {
          $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
        }
      }

      $query->latest();
      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

      $resourceCollection = GelangResource::collection($paginatedData);

      return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
    } catch (\Exception $e) {
      return ApiResponse::error('Failed to get data.', $e->getMessage());
    }
  }
  // public function index(Request $request)
  // {
  //     $gelang_id = $request->input('gelang_id');
  //     $ruangan_otmil_id = $request->input('ruangan_otmil_id');
  //     $ruangan_lemasmil_id = $request->input('ruangan_lemasmil_id');
  //     $perPage = $request->input('per_page', 10);

  //     try {
  //         $query = Gelang::with('ruanganOtmil', 'ruanganLemasmil')
  //             ->where(function ($query) use ($gelang_id, $ruangan_otmil_id, $ruangan_lemasmil_id) {
  //                 if (!empty($gelang_id)) {
  //                     $query->where('id', 'LIKE', '%' . $gelang_id . '%');
  //                 }

  //                 if (!empty($ruangan_otmil_id)) {
  //                     $query->orWhereHas('ruanganOtmil', function ($q) use ($ruangan_otmil_id) {
  //                         $q->where('ruangan_otmil_id', 'LIKE', '%' . $ruangan_otmil_id . '%');
  //                     });
  //                 }

  //                 if (!empty($ruangan_lemasmil_id)) {
  //                     $query->orWhereHas('ruanganLemasmil', function ($q) use ($ruangan_lemasmil_id) {
  //                         $q->where('ruangan_lemasmil_id', 'LIKE', '%' . $ruangan_lemasmil_id . '%');
  //                     });
  //                 }
  //             });

  //         $paginatedData = $query->paginate($perPage);
  //         return ApiResponse::success([
  //             'data' => GelangResource::collection($paginatedData),
  //             'pagination' => [
  //                 'total' => $paginatedData->total(),
  //                 'per_page' => $paginatedData->perPage(),
  //                 'current_page' => $paginatedData->currentPage(),
  //                 'last_page' => $paginatedData->lastPage(),
  //                 'from' => $paginatedData->firstItem(),
  //                 'to' => $paginatedData->lastItem(),
  //             ]
  //         ]);
  //     } catch (\Exception $e) {
  //         return ApiResponse::error('Failed to get data.', $e->getMessage());
  //     }
  // }

  public function store(GelangRequest $request)
  {
    try {
      $gelang = Gelang::create($request->validated());

      return ApiResponse::created($gelang);
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
      $gelang_id = $request->input('gelang_id');
      $gelang = Gelang::findOrFail($gelang_id);

      $existingGelang = Gelang::where('nama_gelang', $gelang->nama_gelang)->first();

      if ($existingGelang && $existingGelang->id !== $gelang_id) {
        return ApiResponse::error('Gelang sudah ada', 500);
      }
      $gelang->update($request->all());
      return ApiResponse::updated($gelang);
    } catch (ModelNotFoundException $e) {
      return ApiResponse::error('Gelang not found', 404);
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    } catch (QueryException $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    }
  }

  public function destroy(Request $request)
  {
    try {
      $gelang_id = $request->input('gelang_id');
      $gelang = Gelang::findOrFail($gelang_id);
      $gelang->delete();
      return ApiResponse::deleted();
    } catch (QueryException $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }
}
