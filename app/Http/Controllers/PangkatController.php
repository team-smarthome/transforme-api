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

    public function index(Request $request)
    {
        try {
            $query = Pangkat::query();
            $filterableColumns = [
                'nama_pangkat' => 'nama_pangkat'
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
