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
            $filterableColumns = [
                'nama_status_wbp_kasus' => 'nama_status_wbp_kasus'
            ];

            $filter = $request->input('filter', []);
            foreach ($filterableColumns as $key => $column) {
                if (isset($filter[$key])) {
                    $query->where($column, 'like', '%' . $filter[$key] . '%');
                }
            }

            $query->latest();
            $paginateData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            return ApiResponse::pagination($paginateData, 'Successfully get Data');
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
