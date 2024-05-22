<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Kesatuan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\KesatuanResource;

class kesatuanController extends Controller
{
  public function index(Request $request)
  {
    $keyword = $request->input('search');

    $findData = Kesatuan::with('lokasiKesatuan')
      ->where('nama_kesatuan', 'LIKE', '%' . $keyword . '%')
      ->get();

    return ApiResponse::success([
      'data' => KesatuanResource::collection($findData),
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama_kesatuan' => 'required|string|max:100',
      'lokasi_kesatuan_id' => 'required|string|max:100',
    ]);

    $kesatuan = Kesatuan::create($request->all());

    return ApiResponse::success([
      'data' => new KesatuanResource($kesatuan),
    ]);
  }
}
