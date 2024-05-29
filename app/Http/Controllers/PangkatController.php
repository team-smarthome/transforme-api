<?php

namespace App\Http\Controllers;

use App\Http\Resources\PangkatResource;
use App\Models\Pangkat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ApiResponse;


class PangkatController extends Controller
{
  public function index()
  {
    {
      try {
        if (request('search')) {
          $query = Pangkat::where('nama_pangkat', 'like', '%' . request('search') . '%')->latest();
        } else {
          $query = Pangkat::latest();
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
      'nama_pangkat' => 'required|string|max:100'
    ]);

    $pangkat = Pangkat::create($request->all());

    return ApiResponse::success([
      'data' => $pangkat
    ]);
  }
}
