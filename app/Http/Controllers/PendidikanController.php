<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\PendidikanResource;
use App\Models\Pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
  public function index(Request $request)
  {
    {
      try {

        $query = Pendidikan::query();
        $filterableColumns = [
          'nama_pendidikan' => 'nama_pendidikan'
        ];

        $filters = $request->input('filter', []);
        foreach ($filterableColumns as $requestKey => $column) {
          if (isset($filters[$requestKey])) {
            $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
          }
        }

        $query->latest();
        $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

        $resourceCollection = PendidikanResource::collection($paginatedData);

        return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
      } catch (\Exception $e) {
        return ApiResponse::error('Failed to get Data.', $e->getMessage());
      }
    }
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama_pendidikan', 'tahun_lulus' => 'required|max:100'
    ]);

    $pendidikan = Pendidikan::create($request->all());

    return ApiResponse::success([
      'data' => $pendidikan
    ]);
  }
}
