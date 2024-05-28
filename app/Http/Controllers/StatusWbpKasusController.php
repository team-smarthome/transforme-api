<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\StatusWbpKasus;
use Illuminate\Http\Request;

class StatusWbpKasusController extends Controller
{
    public function index()
    {
        try {
            if (request('search')) {
                $query = StatusWbpKasus::where('nama_status_wbp_kasus', 'like', '%' . request('search') . '%')->latest();
            } else {
                $query = StatusWbpKasus::latest();
            }

            return ApiResponse::paginate($query);
        } catch (\Throwable $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_status_wbp_kasus' => 'required|string|max:100'
        ]);

        $statusWbp = StatusWbpKasus::create($request->all());

        return ApiResponse::success([
            'data' => $statusWbp
        ]);
    }
}
