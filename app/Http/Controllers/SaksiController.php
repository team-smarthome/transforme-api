<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\SaksiResource;
use App\Models\Saksi;
use Illuminate\Http\Request;

class SaksiController extends Controller
{
    public function index(Request $request)
    {
        $namaSaksi = $request->input('nama_saksi');
        $kasusId = $request->input('kasus_id');
        $perPage = $request->input('per_page', 10);

        try {
            $query = Saksi::with('kasus')
                ->where(function ($query) use ($namaSaksi, $kasusId) {
                    if (!empty($namaSaksi)) {
                        $query->where('nama_saksi', 'LIKE', '%' . $namaSaksi . '%');
                    }

                    if (!empty($kasusId)) {
                        $query->orWhereHas('kasus_id', 'LIKE', '%' . $kasusId . '%');
                    }
                });

            $paginatedData = $query->paginate($perPage);
            return ApiResponse::success([
                'data' => SaksiResource::collection($paginatedData),
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
            'nama_saksi' => 'required|string|max:100',
            'no_kontak' => 'required|string|max:25',
            'alamat' => 'required|string|max:100',
            'jenis_kelamin' => 'required|nullable',
            'kasus_id' => 'required|string|max:36',
            'keterangan' => 'required|string',
        ]);

        $dataSaksi = Saksi::create($request->all());

        return ApiResponse::created([
            'data' => new SaksiResource($dataSaksi)
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_saksi' => 'required|string|max:100',
            'no_kontak' => 'required|string|max:25',
            'alamat' => 'required|string|max:100',
            'jenis_kelamin' => 'required|nullable',
            'kasus_id' => 'required|string|max:36',
            'keterangan' => 'required|string',
        ]);

        $saksiId = $request->input('saksi_id');
        $dataSaksi = Saksi::where('id', $saksiId)->first();
        $dataSaksi->update($request->all());

        return ApiResponse::updated([
            'data' => new SaksiResource($dataSaksi)
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'saksi_id' => 'required|string|max:36'
        ]);

        $saksiId = $request->input('saksi_id');
        $dataSaksi = Saksi::where('id', $saksiId)->first();
        $dataSaksi->delete();

        return ApiResponse::deleted([
            'message' => 'Data saksi berhasil dihapus.'
        ]);
    }
}
