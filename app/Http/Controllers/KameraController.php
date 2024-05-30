<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\KameraRequest;
use App\Models\Kamera;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class KameraController extends Controller
{
  public function index(Request $request)
  {
    try {
      if ($request->has('kamera_id')) {
        $kamera = Kamera::findOrFail($request->kamera_id);
        return response()->json($kamera, 200);
      }

      if ($request->has('nama_kamera')) {
        $query = Kamera::where('nama_kamera', 'like', '%' . $request->nama_kamera . '%')->latest();
      } else {
        $query = Kamera::latest();
      }

      return ApiResponse::paginate($query);
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
    $id = $request->input('id');
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
    $id = $request->input('id');
    $kamera = Kamera::findOrFail($id);
    $kamera->delete();

    return ApiResponse::deleted();
  }
}
