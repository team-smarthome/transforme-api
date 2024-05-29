<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\PetugasRequest;
use App\Models\Petugas;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PetugasController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    try {
      if ($request->has('petugas_id')) {
        $petugas = Petugas::findOrFail($request->petugas_id);
        return response()->json($petugas, 200);
      }
      if ($request->has('nama')) {
        $query = Petugas::where('nama', 'like', '%' . $request->nama . '%')->latest();
      } else {
        $query = Petugas::latest();
      }
      return ApiResponse::paginate($query);
    } catch (\Exception $e) {
      return ApiResponse::error('Failed to get Data.', $e->getMessage());
    }
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

  // public function store(PetugasRequest $request)
  // {
  //   try {
  //     // Begin transaction
  //     DB::beginTransaction();

  //     // Handle file upload for foto_wajah
  //     $fotoWajahPath = null;
  //     if ($request->hasFile('foto_wajah')) {
  //       $fotoWajahPath = $request->file('foto_wajah')->store('images', 'public');
  //     }

  //     // Handle file upload for foto_wajah_fr
  //     $fotoWajahFrPath = null;
  //     if ($request->hasFile('foto_wajah_fr')) {
  //       $fotoWajahFrPath = $request->file('foto_wajah_fr')->store('images', 'public');
  //     }

  //     // Create petugas
  //     $petugas = Petugas::create(array_merge($request->validated(), [
  //       'foto_wajah' => $fotoWajahPath,
  //       'foto_wajah_fr' => $fotoWajahFrPath,
  //     ]));

  //     // Commit transaction
  //     DB::commit();

  //     return ApiResponse::created($petugas);
  //   } catch (QueryException $e) {
  //     // Rollback transaction
  //     DB::rollBack();
  //     return ApiResponse::error('Database error', $e->getMessage(), 500);
  //   } catch (Exception $e) {
  //     // Rollback transaction
  //     DB::rollBack();
  //     return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
  //   }
  // }
  public function store(PetugasRequest $request)
  {
    try {
      if ($request->hasFile('foto_wajah')) {
        $path = $request->file('foto_wajah')->store('public/petugas_images');
        $data['foto_wajah'] = Storage::url($path);
      }

      // Handle file upload for foto_wajah_fr
      if ($request->hasFile('foto_wajah_fr')) {
        $path = $request->file('foto_wajah_fr')->store('public/petugas_images');
        $data['foto_wajah_fr'] = Storage::url($path);
      }
      $petugas = Petugas::create($request->Validated());

      return ApiResponse::created($petugas);
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
  public function edit(PetugasRequest $request)
  {
    try {
      $id = $request->input('id');
      $petugas = Petugas::findOrFail($id);

      // Handle file upload for foto_wajah
      if ($request->hasFile('foto_wajah')) {
        // Delete old file if exists
        if ($petugas->foto_wajah) {
          Storage::disk('public')->delete($petugas->foto_wajah);
        }

        $path = $request->file('foto_wajah')->store('images', 'public');
        $request->merge(['foto_wajah' => $path]);
      }

      // Handle file upload for foto_wajah_fr
      if ($request->hasFile('foto_wajah_fr')) {
        // Delete old file if exists
        if ($petugas->foto_wajah_fr) {
          Storage::disk('public')->delete($petugas->foto_wajah_fr);
        }

        $path = $request->file('foto_wajah_fr')->store('images', 'public');
        $request->merge(['foto_wajah_fr' => $path]);
      }

      $petugas->update($request->validated());

      return ApiResponse::updated($petugas);
    } catch (QueryException $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }

  /**
   * Update the specified resource in storage.
   */

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request)
  {
    try {
      $id = $request->input('id');
      $petugas = Petugas::findOrFail($id);
      $petugas->delete();

      return ApiResponse::deleted();
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }
}
