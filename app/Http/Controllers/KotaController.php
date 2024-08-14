<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\HakimResource;
use App\Helpers\ApiResponse;
use App\Http\Resources\KotaResource;
use App\Models\Kota;

class KotaController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = Kota::query();
      $filterableColumns = [
        'kota_id' => 'id',
        'nama_kota' => 'nama_kota',
        'provinsi_id' => 'provinsi_id',
      ];

      $filters = $request->input('filter', []);

      foreach ($filterableColumns as $requestKey => $column) {
        if (isset($filters[$requestKey])) {
          $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
        }
      }

      // foreach ($filterableColumns as $requestKey => $column) {
      //     if ($value = request($requestKey)) {
      //         $query->where($column, 'like', '%' . $value . '%');
      //     }
      // }

      $query->latest();
      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

      $resourceCollection = KotaResource::collection($paginatedData);

      return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
      // $resource = HakimResource::collection($data);
      // return ApiResponse::pagination($data, $resource);
      // return ApiResponse::paginate($query);
      // return $query->paginate();

    } catch (\Exception $e) {
      return ApiResponse::error('Failed to get Data.', $e->getMessage());
    }
  }
}
