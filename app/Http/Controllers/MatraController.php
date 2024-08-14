<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Matra;
use Illuminate\Http\Request;
use App\Http\Resources\MatraResource;
use PhpParser\Node\Stmt\TryCatch;

class MatraController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Matra::query();
            $filterableColumns = [
                'matra_id' => 'id',
                'nama_matra' => 'nama_matra'
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
                }
            }

            $query->latest();
            $paginateData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = MatraResource::collection($paginateData);

            return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
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
