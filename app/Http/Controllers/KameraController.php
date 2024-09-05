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
      $nama_kamera = $request->input('nama_kamera');
      $status_kamera = $request->input('status_kamera');
      $is_play = $request->input('is_play');
      $gedung_otmil_id = $request->input('gedung_otmil_id');
      $lantai_otmil_id = $request->input('lantai_otmil_id');
      $ruangan_otmil_id = $request->input('ruangan_otmil_id');
      $pageSize = $request->input('pageSize', ApiResponse::$defaultPagination);

      $query = Kamera::with(['ruanganOtmil.lantaiOtmil.gedungOtmil', 'ruanganLemasmil'])
        ->where('id', 'ILIKE', '%' . $kamera_id . '%')
        ->where('nama_kamera', 'ILIKE', '%' . $nama_kamera . '%')
        ->where('status_kamera', 'ILIKE', '%' . $status_kamera . '%')
        ->where('is_play', 'ILIKE', '%' . $is_play . '%');

      // Filter berdasarkan gedung_otmil_id melalui relasi
      if ($request->has('gedung_otmil_id')) {
        $gedung_otmil_id = $request->input('gedung_otmil_id');
        if (is_array($gedung_otmil_id)) {
          $query->whereHas('ruanganOtmil.lantaiOtmil.gedungOtmil', function ($q) use ($gedung_otmil_id) {
            $q->whereIn('id', $gedung_otmil_id);
          });
        } else {
          $query->whereHas('ruanganOtmil.lantaiOtmil.gedungOtmil', function ($q) use ($gedung_otmil_id) {
            $q->where('id', $gedung_otmil_id);
          });
        }
      }
      // Filter berdasarkan lantai_otmil_id
      if ($request->has('lantai_otmil_id')) {
        $lantai_otmil_id = $request->input('lantai_otmil_id');
        if (is_array($lantai_otmil_id)) {
          $query->whereHas('ruanganOtmil.lantaiOtmil', function ($q) use ($lantai_otmil_id) {
            $q->whereIn('id', $lantai_otmil_id);
          });
        } else {
          $query->whereHas('ruanganOtmil.lantaiOtmil', function ($q) use ($lantai_otmil_id) {
            $q->where('id', $lantai_otmil_id);
          });
        }
      }

      // Filter berdasarkan ruangan_otmil_id
      if ($request->has('ruangan_otmil_id')) {
        $ruangan_otmil_id = $request->input('ruangan_otmil_id');
        if (is_array($ruangan_otmil_id)) {
          $query->whereIn('ruangan_otmil_id', $ruangan_otmil_id);
        } else {
          $query->where('ruangan_otmil_id', $ruangan_otmil_id);
        }
      }

      $query->latest();
      $paginatedData = $query->paginate($pageSize);

      $resourceCollection = KameraResource::collection($paginatedData);
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
