<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
  public function index()
  {
    {
      try {
        if (request('search')) {
          $query = Pendidikan::where('nama_pendidikan', 'like', '%' . request('search') . '%')->latest();
        } else {
          $query = Pendidikan::latest();
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
      'nama_pendidikan', 'tahun_lulus' => 'required|max:100'
    ]);

    $pendidikan = Pendidikan::create($request->all());

    return ApiResponse::success([
      'data' => $pendidikan
    ]);
  }
}
