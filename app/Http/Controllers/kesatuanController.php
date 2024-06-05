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
        $namaKesatuan = $request->input('nama_kesatuan');
        $namaLokasiKesatuan = $request->input('nama_lokasi_kesatuan');
        $perPage = $request->input('per_page', 10);

        try {
            $query = Kesatuan::with('lokasiKesatuan')
                ->where(function ($query) use ($namaKesatuan, $namaLokasiKesatuan) {
                    if (!empty($namaKesatuan)) {
                        $query->where('nama_kesatuan', 'LIKE', '%' . $namaKesatuan . '%');
                    }

                    if (!empty($namaLokasiKesatuan)) {
                        $query->orWhereHas('lokasiKesatuan', function ($q) use ($namaLokasiKesatuan) {
                            $q->where('nama_lokasi_kesatuan', 'LIKE', '%' . $namaLokasiKesatuan . '%');
                        });
                    }
                });
                $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

                $resourceCollection = KesatuanResource::collection($paginatedData);

                return ApiResponse::pagination($resourceCollection);
            // $paginatedData = $query->paginate($perPage);
            // return ApiResponse::success([
            //     'data' => KesatuanResource::collection($paginatedData),
            //     'pagination' => [
            //         'total' => $paginatedData->total(),
            //         'per_page' => $paginatedData->perPage(),
            //         'current_page' => $paginatedData->currentPage(),
            //         'last_page' => $paginatedData->lastPage(),
            //         'from' => $paginatedData->firstItem(),
            //         'to' => $paginatedData->lastItem(),
            //     ]
            // ]);
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
