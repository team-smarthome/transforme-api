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



  public function store(PetugasRequest $request)
  {
    try {
      $data = $request->validated();

      if ($request->hasFile('foto_wajah')) {
        $path = Storage::putFile('foto_wajah', $request->file('foto_wajah'));

        $data['foto_wajah'] = 'storage/' . str_replace('public/', '', $path);
      }

      if ($request->hasFile('foto_wajah_fr')) {
        $path = Storage::putFile('foto_wajah_fr', $request->file('foto_wajah_fr'));

        $data['foto_wajah_fr'] = 'storage/' . str_replace('public/', '', $path);
      }


      $petugas = Petugas::create($data);

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
      $data = $request->validated();

      if ($request->hasFile('foto_wajah')) {
        if ($petugas->foto_wajah) {
          Storage::delete(str_replace('storage/', 'public/', $petugas->foto_wajah));
        }

        $path = Storage::putFile('foto_wajah', $request->file('foto_wajah'));
        // Simpan path dengan format yang diinginkan
        $data['foto_wajah'] = 'storage/' . str_replace('public/', '', $path);
      }

      if ($request->hasFile('foto_wajah_fr')) {
        if ($petugas->foto_wajah_fr) {
          Storage::delete(str_replace('storage/', 'public/', $petugas->foto_wajah_fr));
        }

        $path = Storage::putFile('foto_wajah_fr', $request->file('foto_wajah_fr'));
        // Simpan path dengan format yang diinginkan
        $data['foto_wajah_fr'] = 'storage/' . str_replace('public/', '', $path);
      }

      $petugas->update($data);

      return ApiResponse::updated($petugas);
    } catch (QueryException $e) {
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }


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
