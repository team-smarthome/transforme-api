<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Helpers\Helpers;
use App\Helpers\ApiResponse;
use App\Http\Requests\PetugasRequest;
use App\Http\Resources\PetugasResource;
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
      $query = Petugas::with(['pangkat', 'kesatuan', 'provinsi', 'kota', 'agama', 'status_kawin', 'pendidikan', 'pendidikan', 'bidang_keahlian', 'lokasi_otmil', 'lokasi_lemasmil']);

      $filterableColumns = [
        'petugas_id' => 'id',
        'grup_petugas_id' => 'grup_petugas_id',
        'nrp' => 'nrp',
        'nama' => 'nama',
        'jabatan' => 'jabatan',
        'lokasi_otmil_id' => 'lokasi_otmil_id',
        'lokasi_lemasmil_id' => 'lokasi_lemasmil_id',
      ];

      foreach ($filterableColumns as $requestKey => $column) {
        if ($request->has($requestKey)) {
          // Cek jika param adalah array
          if (is_array($request->input($requestKey))) {
            $query->whereIn($column, $request->input($requestKey));
          } else {
            $query->where($column, 'like', '%' . $request->input($requestKey) . '%');
          }
        }
      }

      $query->latest();
      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

      $resourceCollection = PetugasResource::collection($paginatedData);

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
  }

  /**
   * Store a newly created resource in storage.
   */



  public function store(PetugasRequest $request)
  {
    $uuid = Uuid::uuid4()->toString();
    $base64Image = $request['foto_wajah'];
    $image = Helpers::HandleImageToBase64($base64Image, 'petugas-images');
    try {
      DB::beginTransaction();

      $validationExistPetugas = Petugas::where('nrp', $request['nrp'])->first();
      if ($validationExistPetugas) {
        return response()->json([
          'status' => 'Failed',
          'message' => 'Petugas with this NRP already exists.',
        ], 409);
      }

      $dataPetugas = Petugas::create([
        'id' => $uuid,
        'nama' => $request['nama'],
        'pangkat_id' => $request['pangkat_id'],
        'kesatuan_id' => $request['kesatuan_id'],
        'tempat_lahir' => $request['tempat_lahir'],
        'tanggal_lahir' => $request['tanggal_lahir'],
        'jenis_kelamin' => $request['jenis_kelamin'],
        'provinsi_id' => $request['provinsi_id'],
        'kota_id' => $request['kota_id'],
        'alamat' => $request['alamat'],
        'agama_id' => $request['agama_id'],
        'status_kawin_id' => $request['status_kawin_id'],
        'pendidikan_id' => $request['pendidikan_id'],
        'bidang_keahlian_id' => $request['bidang_keahlian_id'],
        'foto_wajah' => $image,
        'jabatan' => $request['jabatan'],
        'nomor_petugas' => $request['nomor_petugas'],
        'lokasi_otmil_id' => $request['lokasi_otmil_id'],
        'lokasi_lemasmil_id' => $request['lokasi_lemasmil_id'],
        'grup_petugas_id' => $request['grup_petugas_id'],
        'lokasi_kesatuan_id' => $request['lokasi_kesatuan_id'],
        'divisi' => $request['divisi'],
        'foto_wajah_fr' => $base64Image,
        'matra_id' => $request['matra_id'],
        'nrp' => $request['nrp'],
      ]);
      DB::commit();
      return response()->json([
        'status' => 'OK',
        'message' => 'Successfully created data.',
      ], 201);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json([
        'status' => 'Failed',
        'message' => 'Failed to create data.',
        'error' => $e->getMessage(),
      ], 500);
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
      DB::beginTransaction();
      $findPetugas = Petugas::where('id', $request['petugas_id'])->first();
      $image = $request['foto_wajah'];
      if (strpos($image, 'data:image/') === 0 && $image != $findPetugas->foto_wajah) {
        $image = Helpers::HandleImageToBase64($image, 'petugas-images');
      }
      $data_foto_wajah_fr = $request['foto_wajah'] == $findPetugas->foto_wajah_fr ? $findPetugas->foto_wajah_fr : $request['foto_wajah'];
      $updatePetugas = Petugas::where('id', $request['petugas_id'])
        ->update([
          'nama' => $request['nama'],
          'pangkat_id' => $request['pangkat_id'],
          'kesatuan_id' => $request['kesatuan_id'],
          'tempat_lahir' => $request['tempat_lahir'],
          'tanggal_lahir' => $request['tanggal_lahir'],
          'jenis_kelamin' => $request['jenis_kelamin'],
          'provinsi_id' => $request['provinsi_id'],
          'kota_id' => $request['kota_id'],
          'alamat' => $request['alamat'],
          'agama_id' => $request['agama_id'],
          'status_kawin_id' => $request['status_kawin_id'],
          'pendidikan_id' => $request['pendidikan_id'],
          'bidang_keahlian_id' => $request['bidang_keahlian_id'],
          'jabatan' => $request['jabatan'],
          // 'nomor_petugas' => $request['nomor_petugas'],
          'lokasi_otmil_id' => $request['lokasi_otmil_id'],
          'lokasi_lemasmil_id' => $request['lokasi_lemasmil_id'],
          'grup_petugas_id' => $request['grup_petugas_id'],
          'lokasi_kesatuan_id' => $request['lokasi_kesatuan_id'],
          'divisi' => $request['divisi'],
          'matra_id' => $request['matra_id'],
          'nrp' => $request['nrp'],
          'foto_wajah' => $image,
          'foto_wajah_fr' => $data_foto_wajah_fr,
        ]);
      DB::commit();

      return response()->json([
        'status' => 'OK',
        'message' => 'Successfully updated data.',
      ], 201);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json([
        'status' => 'Failed',
        'message' => 'Failed to create data.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }


  public function destroy(Request $request)
  {
    try {
      $id = $request->input('petugas_id');
      $petugas = Petugas::findOrFail($id);
      $petugas->delete();

      return ApiResponse::deleted();
    } catch (Exception $e) {
      return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
    }
  }
}
