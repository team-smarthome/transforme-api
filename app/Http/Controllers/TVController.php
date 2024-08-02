<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\TvRequest;
use App\Http\Resources\TvResource;
use App\Models\TV;
use Exception;
use Illuminate\Http\Request;

class TVController extends Controller
{
  public function index(Request $request)
  {
    try {
      $query = TV::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);
      $filterableColumns = [
        'lokasi_otmil_id' => 'ruanganOtmil.lokasiOtmil.lokasi_otmil_id',
        'lokasi_lemasmil_id' => 'ruanganLemasmil.lokasiLemasmil.lokasi_lemasmil_id',
        'ruangan_otmil_id' => 'ruangan_otmil_id',
        'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
        'gmac' => 'gmac',
        'nama_tv' => 'nama_tv',
        'model' => 'model',
        'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
        'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan_lemasmil',
        'jenis_ruangan_otmil' => 'ruanganOtmil.jenis_ruangan_otmil',
        'jenis_ruangan_lemasmil' => 'ruanganLemasmil.jenis_ruangan_lemasmil',
        'status_tv' => 'status_tv'
      ];

      $filters = $request->input('filter', []);

      foreach ($filterableColumns as $requestKey => $column) {
        if (isset($filters[$requestKey])) {
          if ($requestKey === 'nama_ruangan_otmil') {
            $query->whereHas('ruanganOtmil', function ($q) use ($filters, $requestKey) {
              $q->where('nama_ruangan_otmil', 'LIKE', '%' . $filters[$requestKey] . '%');
            });
          } elseif ($requestKey === 'nama_ruangan_lemasmil') {
            $query->whereHas('ruanganLemasmil', function ($q) use ($filters, $requestKey) {
              $q->where('nama_ruangan_lemasmil', 'LIKE', '%' . $filters[$requestKey] . '%');
            });
          } elseif ($requestKey === 'jenis_ruangan_otmil') {
            $query->whereHas('ruanganOtmil', function ($q) use ($filters, $requestKey) {
              $q->where('jenis_ruangan_otmil', 'LIKE', '%' . $filters[$requestKey] . '%');
            });
          } elseif ($requestKey === 'jenis_ruangan_lemasmil') {
            $query->whereHas('ruanganLemasmil', function ($q) use ($filters, $requestKey) {
              $q->where('jenis_ruangan_lemasmil', 'LIKE', '%' . $filters[$requestKey] . '%');
            });
          } elseif ($requestKey === 'lokasi_otmil_id') {
            $query->whereHas('ruanganOtmil.lokasiOtmil', function ($q) use ($filters, $requestKey) {
              $q->where('lokasi_otmil_id', 'LIKE', '%' . $filters[$requestKey] . '%');
            });
          } elseif ($requestKey === 'lokasi_lemasmil_id') {
            $query->whereHas('ruanganLemasmil.lokasiLemasmil', function ($q) use ($filters, $requestKey) {
              $q->where('lokasi_lemasmil_id', 'LIKE', '%' . $filters[$requestKey] . '%');
            });
          } else {
            $query->where($column, 'LIKE', '%' . $filters[$requestKey] . '%');
          }
        }
      }

      $query->latest();
      $accessPointData = $query->get();

      $totalTv = $accessPointData->count();
      $totalaktif = $accessPointData->where('status_tv', 'aktif')->count();
      $totalnonaktif = $accessPointData->where('status_tv', 'nonaktif')->count();

      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = TvResource::collection($paginatedData);

      $responseData = [
        "status" => "OK",
        "message" => "Successfully get Data",
        "records" => $resourceCollection->toArray($request),
        "totalTv" => $totalTv,
        "totalaktif" => $totalaktif,
        "totalnonaktif" => $totalnonaktif,
        "pagination" => [
          "currentPage" => $paginatedData->currentPage(),
          "pageSize" => $paginatedData->perPage(),
          "from" => $paginatedData->firstItem(),
          "to" => $paginatedData->lastItem(),
          "totalRecords" => $paginatedData->total(),
          "totalPages" => $paginatedData->lastPage()
        ]
      ];

      return response()->json($responseData);
    } catch (\Exception $e) {
      return ApiResponse::error('Failed to get Data.', $e->getMessage());
    }
  }

    public function store(TvRequest $request)
    {
        try {
            if (TV::where('gmac', $request->gmac)->exists()) {
                return ApiResponse::error('Failed to create TV.', 'Gmac already exists.');
            }

            $tv = new TV([
                'gmac' => $request->gmac,
                'nama_tv' => $request->nama_tv,
                'model' => $request->model,
                'ruangan_otmil_id' => $request->ruangan_otmil_id,
                'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
                'status_tv' => $request->status_tv,
                'v_tv_topic' => $request->v_tv_topic
            ]);

            if ($tv->save()) {
                $data = $tv->toArray();
                $formattedData = array_merge(['id' => $tv->id], $data);
                return ApiResponse::created($formattedData);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create TV.', $e->getMessage());
        }
    }

    public function update(TvRequest $request)
    {
        try {
            $id = $request->input('tv_id');
            $tv = TV::findOrFail($id);
            $tv->gmac = $request->gmac;
            $tv->model = $request->model;
            $tv->nama_tv = $request->nama_tv;
            $tv->ruangan_otmil_id = $request->ruangan_otmil_id;
            $tv->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $tv->status_tv = $request->status_tv;
            $tv->v_tv_topic = $request->v_tv_topic;

            if ($tv->save()) {
                $data = $tv->toArray();
                return ApiResponse::updated($data);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update TV.', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->input('tv_id');
            $tv = TV::findOrFail($id);
            if (!$tv) {
                return ApiResponse::error('TV not found.', 'TV not found.', 404);
            }
            $tv->delete();
            return ApiResponse::deleted();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete TV.', $e->getMessage());
        }
    }
}