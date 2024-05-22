<?php

namespace App\Http\Controllers;

use App\Models\StatusKawin;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Response;
use App\Helpers\ApiResponse;

class StatusKawinController extends Controller
{
  public function index()
  {
    {
      try {
        if (request('search')) {
          $query = StatusKawin::where('nama_status_kawin', 'like', '%' . request('search') . '%')->latest();
        } else {
          $query = StatusKawin::latest();
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
      'nama_status_kawin' => 'required|string|max:100'
    ]);

    $statusKawin = StatusKawin::create($request->all());

    return ApiResponse::success([
      'data' => $statusKawin
    ]);
  }
}
