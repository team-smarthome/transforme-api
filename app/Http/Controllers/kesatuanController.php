<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Kesatuan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\KesatuanResource;

class kesatuanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Kesatuan::with('lokasiKesatuan');
            $filterableColumns = [
                'nama_kesatuan' => 'nama_kesatuan',
                'nama_lokasi_kesatuan' => 'lokasiKesatuan.nama_lokasi_kesatuan'
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    if ($requestKey === 'nama_lokasi_kesatuan') {
                        // Handle the relationship filter
                        $query->whereHas('lokasiKesatuan', function ($q) use ($filters, $requestKey) {
                            $q->where('nama_lokasi_kesatuan', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } else {
                        $query->where($column, 'LIKE', '%' . $filters[$requestKey] . '%');
                    }
                }
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', 10));
            $resourceCollection = KesatuanResource::collection($paginatedData);

            // Wrap the paginated data in a LengthAwarePaginator
            $paginatedData->setCollection($resourceCollection->collection);

            // Pass the LengthAwarePaginator instance to ApiResponse::pagination
            return ApiResponse::pagination($paginatedData, 'Successfully get data');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred while fetching data.', $e->getMessage());
        }
    }





    public function store(Request $request)
    {
        $request->validate([
            'nama_kesatuan' => 'required|string|max:100',
            'lokasi_kesatuan_id' => 'required|string|max:100',
        ]);

        $kesatuan = Kesatuan::create($request->all());

        return ApiResponse::success([
            'data' => new KesatuanResource($kesatuan),
        ]);
    }
}
