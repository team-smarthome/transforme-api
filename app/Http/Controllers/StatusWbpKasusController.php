<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\StatusWbpKasus;
use Illuminate\Http\Request;

class StatusWbpKasusController extends Controller
{
    public function index(Request $request)
    {
        try {
            
            $query = StatusWbpKasus::query();

            if ($request->has('nama_bidang_keahlian')) {
                $query->where('nama_bidang_keahlian', 'like', '%' . $request->input('nama_bidang_keahlian') . '%');
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
