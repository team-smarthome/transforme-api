<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gelang;
use App\Helpers\ApiResponse;
use App\Http\Resources\GelangResource;

class GelangController extends Controller
{
    public function index(Request $request)
    {
        $gelang_id = $request->input('gelang_id');
        $ruangan_otmil_id = $request->input('ruangan_otmil_id');
        $ruangan_lemasmil_id = $request->input('ruangan_lemasmil_id');
        $perPage = $request->input('per_page', 10);

        try {
            $query = Gelang::with('ruanganOtmil', 'ruanganLemasmil')
                ->where(function ($query) use ($gelang_id, $ruangan_otmil_id, $ruangan_lemasmil_id) {
                    if (!empty($gelang_id)) {
                        $query->where('id', 'LIKE', '%' . $gelang_id . '%');
                    }

                    if (!empty($ruangan_otmil_id)) {
                        $query->orWhereHas('ruanganOtmil', function ($q) use ($ruangan_otmil_id) {
                            $q->where('ruangan_otmil_id', 'LIKE', '%' . $ruangan_otmil_id . '%');
                        });
                    }

                    if (!empty($ruangan_lemasmil_id)) {
                        $query->orWhereHas('ruanganLemasmil', function ($q) use ($ruangan_lemasmil_id) {
                            $q->where('ruangan_lemasmil_id', 'LIKE', '%' . $ruangan_lemasmil_id . '%');
                        });
                    }
                });

            $paginatedData = $query->paginate($perPage);
            return ApiResponse::success([
                'data' => GelangResource::collection($paginatedData),
                'pagination' => [
                    'total' => $paginatedData->total(),
                    'per_page' => $paginatedData->perPage(),
                    'current_page' => $paginatedData->currentPage(),
                    'last_page' => $paginatedData->lastPage(),
                    'from' => $paginatedData->firstItem(),
                    'to' => $paginatedData->lastItem(),
                ]
            ]);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get data.', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'dmac' => 'required|string|max:100',
            'nama_gelang' => 'required|string|max:100',
            'tanggal_pasang' => 'required|date',
            'tanggal_aktivasi' => 'required|date',
            'ruangan_otmil_id' => 'required|string|max:36',
            'ruangan_lemasmil_id' => 'required|string|max:36',
            'baterai' => 'required|string|max:100'
        ]);

        $dataGelang = Gelang::create($request->all());

        return ApiResponse::created([
            'data' => new GelangResource($dataGelang),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'gelang_id' => 'required|string|max:36',
            'dmac' => 'required|string|max:100',
            'nama_gelang' => 'required|string|max:100',
            'tanggal_pasang' => 'nullable|date',
            'tanggal_aktivasi' => 'nullable|date',
            'ruangan_otmil_id' => 'required|string|max:36',
            'ruangan_lemasmil_id' => 'required|string|max:36',
            'baterai' => 'nullable|string'
        ]);

        $gelang_id = $request->input('gelang_id');
        $dataGelang = Gelang::where('id', $gelang_id)->firstOrFail();
        $dataGelang->update($request->all());

        return ApiResponse::updated([
            'data' => new GelangResource($dataGelang),
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'gelang_id' => 'required|string|max:36'
        ]);

        $gelang_id = $request->input('gelang_id');
        $dataGelang = Gelang::where('id', $gelang_id)->firstOrFail();
        $dataGelang->delete();

        return ApiResponse::deleted([
            'message' => 'Data deleted successfully'
        ]);
    }
}
