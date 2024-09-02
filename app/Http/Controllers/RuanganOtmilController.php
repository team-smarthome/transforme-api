<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\RuanganOtmil;
use App\Http\Resources\RuanganOtmilResource;

class RuanganOtmilController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = RuanganOtmil::with('lokasiOtmil', 'lantaiOtmil', 'zona');
      $filterData = [
        'nama_ruangan_otmil' => 'nama_ruangan_otmil',
        'jenis_ruangan_otmil' => 'jenis_ruangan_otmil',
        'lantai_otmil_id' => 'lantai_otmil_id'
      ];



      foreach ($filterData as $field => $requestParam) {
        if ($request->has($requestParam)) {
          if ($field == 'nama_ruangan_otmil') {
            $query->where($field, 'ILIKE', '%' . $request->input($requestParam) . '%');
          } else {
            $query->where($field, 'ILIKE', '%' . $request->input($requestParam) . '%');
          }
        }
      }
      $query->latest();
      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = RuanganOtmilResource::collection($paginatedData);

      return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
      // $nama = $request->input('search');
      // $searchType = $request->input('searchType');
      // $pageSize = $request->input('pageSize', ApiResponse::$defaultPagination);

      // $query = RuanganOtmil::with(['lokasiOtmil', 'lantaiOtmil', 'zona'])
      // ->where('nama_ruangan_otmil', 'LIKE', '%'. $search . '%')
      // ->where('jenis_ruangan_otmil', 'LIKE', '%'. $searchType . '%')
      // ->latest()->paginate($pageSize);

      // $resourceCollection = RuanganOtmilResource::collection($query);

      // return ApiResponse::pagination($resourceCollection);
    } catch (\Exception $e) {
      return ApiResponse::error('An error occurred while fetching data.', $e->getMessage());
    }
  }

  public function store(Request $request)
  {
    try {
      $request->validate([
        'nama_ruangan_otmil' => 'required|string',
        'jenis_ruangan_otmil' => 'required|string',
        'lokasi_otmil_id' => 'required|string',
        'lantai_otmil_id' => 'required|string',
        'zona_id' => 'required|string',
        'panjang' => 'nullable',
        'lebar' => 'nullable',
        'posisi_X' => 'nullable',
        'posisi_Y' => 'nullable'
      ]);
      $insert = RuanganOtmil::create($request->all());
      return ApiResponse::success([
        'data' => $insert
      ]);
    } catch (\Exception $e) {
      return ApiResponse::error('An error occurred while fetching data.', $e->getMessage());
    }
  }

  public function show(Request $request)
  {
    $ruangan_otmil_id = $request->input('ruangan_otmil_id');
    $dataRuangan = RuanganOtmil::where('id', $ruangan_otmil_id)->firstOrFail();

    return ApiResponse::success([
      'data' => $dataRuangan
    ]);
  }

  public function update(Request $request)
  {
    $request->validate([
      'nama_ruangan_otmil' => 'required|string',
      'jenis_ruangan_otmil' => 'required|string',
      'lokasi_otmil_id' => 'required|string',
      'lantai_otmil_id' => 'required|string',
      'zona_id' => 'required|string',
      'panjang' => 'nullable',
      'lebar' => 'nullable',
      'posisi_X' => 'nullable',
      'posisi_Y' => 'nullable'
    ]);
    $ruangan_otmil_id = $request->input('ruangan_otmil_id');
    $findLantai = RuanganOtmil::where('id', $ruangan_otmil_id)->firstOrFail();
    $findLantai->nama_ruangan_otmil = $request->input('nama_ruangan_otmil');
    $findLantai->lokasi_otmil_id = $request->input('lokasi_otmil_id');
    $findLantai->jenis_ruangan_otmil = $request->input('jenis_ruangan_otmil');
    $findLantai->lantai_otmil_id = $request->input('lantai_otmil_id');
    $findLantai->zona_id = $request->input('zona_id');
    $findLantai->panjang = $request->input('panjang');
    $findLantai->lebar = $request->input('lebar');
    $findLantai->posisi_X = $request->input('posisi_X');
    $findLantai->posisi_Y = $request->input('posisi_Y');

    $findLantai->save();
    return ApiResponse::updated();
  }

  public function destroy(Request $request)
  {
    $ruangan_otmil_id = $request->input('ruangan_otmil_id');
    $ruangan_otmil = RuanganOtmil::findOrFail($ruangan_otmil_id);
    $ruangan_otmil->delete();

    return ApiResponse::deleted();
  }
}
