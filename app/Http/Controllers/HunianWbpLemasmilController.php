<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\HunianWbpLemasmilResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\HunianWbpLemasmil;

class HunianWbpLemasmilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = HunianWbpLemasmil::with(['lokasiLemasmil']);
        $filterableColumns = [
            'hunian_wbp_lemasmil_id' => 'id',
            'nama_hunian_wbp_lemasmil' => 'nama_hunian_wbp_lemasmil',
            'lokasi_lemasmil_id' => 'lokasi_lemasmil_id',
            'nama_lokasi_lemasmil' => 'lokasiLemasmil.nama_lokasi_lemasmil'
        ];
        $filters = $request->input('filter', []);

        foreach ($filterableColumns as $requestKey => $column) {
            if (isset($filters[$requestKey])) {
                $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
            }
        }

        $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

        $query->latest();
        $resourceCollection = HunianWbpLemasmilResource::collection($paginatedData);

        return ApiResponse::pagination($resourceCollection);
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
    public function store(Request $request)
    {
        $request->validate([
            'lokasi_lemasmil_id' => 'required|string|max:100',
            'nama_hunian_wbp_lemasmil' => 'required|string|max:100'
        ]);

        $hunianWbpLemasmil = HunianWbpLemasmil::create($request->all());
        return ApiResponse::success([
            'data' => new HunianWbpLemasmilResource($hunianWbpLemasmil)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->input('id');
        $hunianWbpLemasmil = HunianWbpLemasmil::findOrFail($id);
        return response()->json($hunianWbpLemasmil, 200);
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
        $id = $request->input('id');
        $hunianWbpLemasmil = HunianWbpLemasmil::findOrFail($id);

        $existingHunianWbpLemasmil = HunianWbpLemasmil::where('nama_hunian_wbp_lemasmil', $hunianWbpLemasmil->nama_hunian_wbp_lemasmil)->first();

        if ($existingHunianWbpLemasmil && $existingHunianWbpLemasmil->id !== $id) {
            return ApiResponse::error('Nama hunian wbp lemasmil sudah ada.', null, 422);
        }

        $hunianWbpLemasmil->update($request->all());
        return ApiResponse::success([
            'data' => new HunianWbpLemasmilResource($hunianWbpLemasmil)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $hunianWbpLemasmil = HunianWbpLemasmil::findOrFail($id);
        $hunianWbpLemasmil->delete();

        return ApiResponse::deleted();
    }

    public function restore($id){
        $hunianWbpLemasmil = HunianWbpLemasmil::withTrashed()->findOrFail($id);
        $hunianWbpLemasmil->restore();

        return response()->json($hunianWbpLemasmil);
    }
}
