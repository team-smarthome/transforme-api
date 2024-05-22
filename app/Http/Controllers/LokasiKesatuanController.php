<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LokasiKesatuan;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\ApiResponse;

class LokasiKesatuanController extends Controller
{
  public function index(Request $request)
  {
    {
      try {
        if (request('search')) {
          $query = LokasiKesatuan::where('nama_lokasi_kesatuan', 'like', '%' . request('search') . '%')->latest();
        } else {
          $query = LokasiKesatuan::latest();
        }

        return ApiResponse::paginate($query);
      } catch (\Exception $e) {
        return ApiResponse::error('Failed to get Data.', $e->getMessage());
      }
    }
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama_lokasi_kesatuan' => 'required|string|max:100'
    ]);

    $lokasiKesatuan = LokasiKesatuan::create($request->all());

    return ApiResponse::success([
      'data' => $lokasiKesatuan
    ]);
  }
}
