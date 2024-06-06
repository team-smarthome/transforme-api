<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\Ahli;
use Illuminate\Database\QueryException;
use Exception;
use App\Http\Requests\AhliRequest;
use App\Http\Resources\AhliResource;

class AhliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // if ($request->has('ahli_id')) {
            //     $ahli = Ahli::findOrFail($request->ahli_id);
            //     return response()->json($ahli, 200);
            // }

            // if ($request->has('nama_ahli')) {
            //     $query = Ahli::where('nama_ahli','like','%'. $request->nama_ahli . '%')->latest();
            // } else {
            //     $query = Ahli::latest();
            // }

            // return ApiResponse::paginate($query);
            $query = Ahli::query();
            $filterableColumns = [
                'ahli_id' => 'id',
                'nama_ahli' => 'nama_ahli',
                'bidang_ahli' => 'bidang_ahli',
                'bukti_keahlian' => 'bukti_keahlian'
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    $query->where($column, 'like', '%' . $filters[$requestKey] .'%');
                }
            }

            $query->latest();
            $paginateData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = AhliResource::collection($paginateData);

            return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
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
    public function store(AhliRequest $request)
    {
        try {
            $ahli = Ahli::create($request->validated());

            return ApiResponse::created($ahli);
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(),500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->input('id');
        $ahli = Ahli::findOrFail($id);
        return response()->json($ahli, 200);
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
    public function update(AhliRequest $request)
    {
        $id = $request->input('id');
        $ahli = Ahli::findOrFail($id);

        // Check if the updated name already exists
        $existingAhli = Ahli::where('nama_ahli', $ahli->nama_ahli)->first();
        
        if ($existingAhli && $existingAhli->id !== $id) {
            return ApiResponse::error('Nama ahli sudah ada.', null, 422);
        }

        $ahli->update($request->all());
        return ApiResponse::updated($ahli);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $ahli = Ahli::findOrFail($id);
        $ahli->delete();

        return ApiResponse::deleted();
    }

    public function restore($id){
        $ahli = Ahli::withTrashed()->findOrFail($id);
        $ahli->restore();

        return response()->json($ahli);
    }
}
