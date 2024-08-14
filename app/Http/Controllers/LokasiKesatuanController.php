<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LokasiKesatuan;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\ApiResponse;

class LokasiKesatuanController extends Controller
{
    public function index(Request $request)
    { {
            try {
                $query = LokasiKesatuan::query();
                $filterableColumns = [
                    'nama_lokasi_kesatuan' => 'nama_lokasi_kesatuan'
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
            'nama_lokasi_kesatuan' => 'required|string|max:100'
        ]);

        $lokasiKesatuan = LokasiKesatuan::create($request->all());

        return ApiResponse::success([
            'data' => $lokasiKesatuan
        ]);
    }
}
