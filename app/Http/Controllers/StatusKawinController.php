<?php

namespace App\Http\Controllers;

use App\Models\StatusKawin;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Response;
use App\Helpers\ApiResponse;

class StatusKawinController extends Controller
{
    public function index(Request $request)
    { {
            try {
                $query = StatusKawin::query();
                $filterableColumns = [
                    'nama_status_kawin' => 'nama_status_kawin'
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
