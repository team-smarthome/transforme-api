<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\TipeAset;
use App\Http\Resources\TipeAsetResource;
use Illuminate\Database\QueryException;
use Exception;
use App\Http\Requests\TipeAsetRequest;


class TipeAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = TipeAset::query();
            $filterableColumns = [
                'tipe_aset_id' => 'id',
                'nama_tipe' => 'nama_tipe',
            ];

            $filters = request('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
                }
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = TipeAsetResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection);

        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipeAsetRequest $request)
    {
        try {
            $tipe_aset = TipeAset::create($request->validated());

            return ApiResponse::created($tipe_aset);

        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);

        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tipe_aset = TipeAset::findOrFail($id);

        return response()->json($tipe_aset, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_tipe' => 'required|string'
        ]);

        $idTipeAset = $request->input('tipe_aset_id');
        $dataTipe = TipeAset::where('id', $idTipeAset)->first();
        $dataTipe->update($request->all());

        return ApiResponse::updated([
            'data' => 'berhasil'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Request $request)
    {
        $request->validate([
            'tipe_aset_id' => 'required|string|max:36'
        ]);

        $saksiId = $request->input('tipe_aset_id');
        $dataSaksi = TipeAset::where('id', $saksiId)->first();
        $dataSaksi->delete();

        return ApiResponse::deleted([
            'message' => 'Data berhasil dihapus.'
        ]);
    }

    public function restore($id)
    {
        $tipe_aset = TipeAset::withTrashed()->findOrFail($id);
        $tipe_aset->restore();

        return response()->json($tipe_aset);
    }
}
