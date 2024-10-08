<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\GrupPetugas;
use Illuminate\Database\QueryException;
use Exception;
use App\Http\Requests\GrupPetugasRequest;
use App\Http\Resources\GrupPetugasResource;
use App\Models\Hakim;
use App\Models\Petugas;
use Illuminate\Support\Facades\DB;

class GrupPetugasController extends Controller
{
  /**
   * Display a listing of the resource.
   */

  public function index(Request $request)
  {
    try {
      $grup_petugas_id = $request->input('grup_petugas_id');
      $nama_grup_petugas = $request->input('nama_grup_petugas');
      $pageSize = $request->input('pageSize', ApiResponse::$defaultPagination);


      $query = GrupPetugas::with(['petugas'])
        ->where('id', 'LIKE', '%' . $grup_petugas_id . '%')
        ->where('nama_grup_petugas', 'LIKE', '%' . $nama_grup_petugas . '%')
        ->latest()->paginate($pageSize);



      $resourceCollection = GrupPetugasResource::collection($query);
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
  // public function store(GrupPetugasRequest $request)
  // {
  //   try {
  //     $grup_petugas = GrupPetugas::create($request->validated());

  //     return ApiResponse::created($grup_petugas);
  //   } catch (QueryException $e) {
  //     // Menangani kesalahan query database, seperti pelanggaran constraint unik
  //     return ApiResponse::error('Database error', $e->getMessage(), 500);
  //   } catch (Exception $e) {
  //     // Menangani semua kesalahan lain yang tidak terduga
  //     return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
  //   }
  // }


  public function store(GrupPetugasRequest $request)
  {
    DB::beginTransaction();

    try {
      // Membuat grup baru
      $grup_petugas = GrupPetugas::create($request->validated());

      // Update petugas yang menjadi ketua
      $ketua_grup_id = $request->input('ketua_grup_id');
      $ketua = Petugas::findOrFail($ketua_grup_id);
      $ketua->grup_petugas_id = $grup_petugas->id;
      $ketua->save();

      DB::commit();

      return ApiResponse::created($grup_petugas);
    } catch (QueryException $e) {
      DB::rollback();
      // Menangani kesalahan query database, seperti pelanggaran constraint unik
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
      DB::rollback();
      // Menangani semua kesalahan lain yang tidak terduga
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }
  /**
   * Display the specified resource.
   */
  public function show(Request $request)
  {
    $id = $request->input('id');
    $grup_petugas = GrupPetugas::findOrFail($id);

    return response()->json($grup_petugas, 200);
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

  public function update(GrupPetugasRequest $request)
  {
    DB::beginTransaction();

    try {
      $grup_petugas_id = $request->input('grup_petugas_id');
      $grup_petugas = GrupPetugas::findOrFail($grup_petugas_id);

      $nama_grup_petugas = $request->input('nama_grup_petugas');


      $existingGrupPetugas = GrupPetugas::where('nama_grup_petugas', $nama_grup_petugas)
        ->where('id', '!=', $grup_petugas_id)
        ->first();

      if ($existingGrupPetugas) {
        return ApiResponse::error('Nama grup petugas sudah ada.', null, 422);
      }

      $grup_petugas->update($request->validated());

      DB::commit();

      return ApiResponse::updated($grup_petugas);
    } catch (QueryException $e) {
      DB::rollback();
      // Menangani kesalahan query database, seperti pelanggaran constraint unik
      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
      DB::rollback();
      // Menangani semua kesalahan lain yang tidak terduga
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }


  /**
   * Remove the specified resource from storage.
   */


  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request)
  {
    DB::beginTransaction();

    try {
      $grup_petugas_id = $request->input('grup_petugas_id');


      $petugasTerpengaruh = Petugas::where('grup_petugas_id', $grup_petugas_id)->get();


      foreach ($petugasTerpengaruh as $petugas) {
        $petugas->grup_petugas_id = null;
        $petugas->save();
      }


      $grup_petugas = GrupPetugas::findOrFail($grup_petugas_id);
      $grup_petugas->delete();

      DB::commit();

      return ApiResponse::deleted();
    } catch (QueryException $e) {
      DB::rollback();

      return ApiResponse::error('Database error', $e->getMessage(), 500);
    } catch (Exception $e) {
      DB::rollback();

      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }

  // public function destroy(Request $request)
  // {
  //   $id = $request->input('grup_petugas_id');
  //   $grup_petugas = GrupPetugas::findOrFail($id);
  //   $grup_petugas->delete();

  //   return ApiResponse::deleted();
  // }

  public function restore($id)
  {
    $grup_petugas = GrupPetugas::withTrashed()->findOrFail($id);
    $grup_petugas->restore();

    return response()->json($grup_petugas);
  }
}
