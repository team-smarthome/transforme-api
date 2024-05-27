<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\JenisPidana;
use Illuminate\Http\Request;

class JenisPidanaController extends Controller
{
    public function index()
    {
        try {
            if (request('search')) {
                $query = JenisPidana::where('nama_jenis_pidana', 'like', '%' . request('search') . '%')->latest();
            } else {
                $query = JenisPidana::latest();
            }

            return ApiResponse::paginate($query);
        } catch (\Throwable $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_pidana' => 'required|string|max:100'
        ]);

        $statusWbp = JenisPidana::create($request->all());

        return ApiResponse::success([
            'data' => $statusWbp
        ]);
    }
}
