<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\KameraRequest;
use App\Http\Resources\KameraResource;
use App\Models\Kamera;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class KameraController extends Controller
{
  public function index(Request $request)
  {
    try {
      $kamera_id = $request->input('kamera_id');
      $search = $request->input('search');
      $status_kamera = $request->input('status_kamera');
      $is_play = $request->input('is_play');
      $pageSize = $request->input('pageSize', ApiResponse::$defaultPagination);


      $query = Kamera::with(['ruanganOtmil', 'ruanganLemasmil'])
        ->where('id', 'ILIKE', '%' . $kamera_id . '%')
        ->where('nama_kamera', 'ILIKE', '%' . $search . '%')
        ->where('status_kamera', 'ILIKE', '%' . $status_kamera . '%')
        ->where('is_play', 'ILIKE', '%' . $is_play . '%')
        ->latest()->paginate($pageSize);


      $resourceCollection = KameraResource::collection($query);
      return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
    } catch (\Exception $e) {
      return ApiResponse::error('Failed to get Data.', $e->getMessage());
    }
  }

  public function store(KameraRequest $request)
  {
    try {
      $kamera = Kamera::create($request->validated());

      return ApiResponse::created($kamera);
    } catch (QueryException $e) {
      // Menangani kesalahan query database, seperti pelanggaran constraint unik
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
      // Menangani semua kesalahan lain yang tidak terduga
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }

  public function update(KameraRequest $request)
  {
    $id = $request->input('kamera_id');
    $kamera = Kamera::findOrFail($id);


    $existingKamera = Kamera::where('nama_kamera', $kamera->nama_kamera)->first();

    if ($existingKamera && $existingKamera->id !== $id) {
      return ApiResponse::error('Nama kamera sudah ada.', null, 422);
    }

    $kamera->update($request->all());

    return ApiResponse::updated($kamera);
  }

  public function destroy(Request $request)
  {
    try {
      $id = $request->input('kamera_id');
      $kamera = Kamera::findOrFail($id);
      $kamera->delete();

      return ApiResponse::deleted();
    } catch (QueryException $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }
}
