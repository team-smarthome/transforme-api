<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Matra;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class MatraController extends Controller
{
    public function index()
    {
        try {
            if (request('nama_matra')) {
                $keyword = Matra::where('nama_matra', 'LIKE', '%' . request('nama_matra') . '%')->latest();
            } else {
                $keyword = Matra::latest();
            }

            return ApiResponse::paginate($keyword);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_matra' => 'required|string|max:100'
        ]);

        $dataMatra = Matra::create($request->all());

        return ApiResponse::created([
            'data' => $dataMatra
        ]);
    }

    public function show(Request $request)
    {
        $request->validate([
            'matra_id' => 'required|string|max:100'
        ]);

        $matra_id = $request->input('matra_id');
        $dataMatra = Matra::where('id', $matra_id)->firstOrFail();

        return ApiResponse::success([
            'data' => $dataMatra
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'matra_id' => 'required|string|max:100',
            'nama_matra' => 'required|string|max:100'
        ]);

        $matra_id = $request->input('matra_id');
        $dataMatra = Matra::where('id', $matra_id)->firstOrFail();
        $dataMatra->update($request->all());

        return ApiResponse::updated([
            'data' => $dataMatra
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'matra_id' => 'required|string|max:100'
        ]);

        $matra_id = $request->input('matra_id');
        $dataMatra = Matra::where('id', $matra_id)->firstOrFail();
        $dataMatra->delete();

        return ApiResponse::deleted([
            'message' => 'Data deleted successfully'
        ]);
    }
}
