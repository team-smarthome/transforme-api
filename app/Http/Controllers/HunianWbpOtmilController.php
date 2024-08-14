<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\HunianWbpOtmil;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\HunianWbpOtmilResource;

class HunianWbpOtmilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = HunianWbpOtmil::query();
        $filterableColumns = [
            'hunian_wbp_otmil_id' => 'id',
            'nama_hunian_wbp_otmil' => 'nama_hunian_wbp_otmil',
            'lokasi_otmil_id' => 'lokasi_otmil_id',
            'nama_lokasi_otmil' => 'lokasiOtmil.nama_lokasi_otmil'
        ];

        $filters = $request->input('filter', []);

        foreach ($filterableColumns as $requestKey => $column) {
            if (isset($filters[$requestKey])) {
                $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
            }
        }

        $query->latest();
        $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
        $resourceCollection = HunianWbpOtmilResource::collection($paginatedData);

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
            'lokasi_otmil_id' => 'required|string|max:100',
            'nama_hunian_wbp_otmil' => 'required|string|max:100'
        ]);

        $hunianWbpOtmil = HunianWbpOtmil::create($request->all());
        return ApiResponse::success([
            'data' => new HunianWbpOtmilResource($hunianWbpOtmil)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->input('id');
        $hunianWbpOtmil = HunianWbpOtmil::findOrFail($id);
        return response()->json($hunianWbpOtmil, 200);
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
        $hunianOtmilId = $request->input('hunian_wbp_otmil_id');
        // $request->validate([
        //     'lokasi_otmil_id' => 'required|string|max:100',
        //     'nama_hunian_wbp_otmil' => 'required|string|max:100'
        // ]);

        $hunianWbpOtmil = HunianWbpOtmil::findOrFail($hunianOtmilId);

        $existingHunianWbpOtmil = HunianWbpOtmil::where('nama_hunian_wbp_otmil', $hunianWbpOtmil->nama_hunian_wbp_otmil)->first();

        if ($existingHunianWbpOtmil && $existingHunianWbpOtmil->id !== $hunianOtmilId) {
            return ApiResponse::error('Nama hunian wbp otmil sudah ada.', null, 422);
        }

        $hunianWbpOtmil->update($request->all());
        return ApiResponse::success([
            'data' => new HunianWbpOtmilResource($hunianWbpOtmil)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('hunian_wbp_otmil_id');
        $hunianWbpOtmil = HunianWbpOtmil::findOrFail($id);
        $hunianWbpOtmil->delete();

        return ApiResponse::deleted();
    }

    public function restore($id)
    {
        $hunianWbpOtmil = HunianWbpOtmil::withTrashed()->findOrFail($id);
        $hunianWbpOtmil->restore();

        return response()->json($hunianWbpOtmil);
    }
}
