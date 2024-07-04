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
        try {
            $query = Saksi::with('kasus');
            $filterableColumns = [
                'nama_saksi' => 'nama_saksi',
                'kasus_id' => 'kasus_id'
            ];

            foreach ($filterableColumns as $field => $requestParam) {
                if ($request->has($requestParam)) {
                    $query->where($field, 'like', '%' . $request->input($requestParam) . '%');
                }
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = SaksiResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection, 'Successfully get Data');

            // $query->latest();
            // $paginateData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            // $resourceCollection = SaksiResource::collection($paginateData);

            // return ApiResponse::pagination($resourceCollection);
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
            'kasus_id' => 'nullable|string|max:36',
            'keterangan' => 'nullable',
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
            'kasus_id' => 'nullable|string|max:36',
            'keterangan' => 'nullable|string',
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
