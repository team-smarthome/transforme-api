<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Requests\ZonaRequest;
use App\Http\Resources\ZonaResource;
use App\Models\Zona;
use Exception;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // if ($request->has('zona_id')) {
            //     $zona = Zona::findOrFail($request->zona_id);
            //     return response()->json($zona, 200);
            // }

            // if ($request->has('nama_zona')) {
            //     $query = Zona::where('nama_zona','LIKE','%'. $request->nama_zona . '%')->latest();
            // } else{
            //     $query = Zona::latest();
            // }

            // return ApiResponse::paginate($query);
            $query = Zona::query();
            $filterableColumns = [
                'zona_id' => 'id',
                'nama_zona' => 'nama_zona',
                'is_deleted' => 'deleted_at'
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    $query->where($column, 'like', '%' . $filters[$requestKey] .'%');
                }
            }

            $query->latest();
            $paginateDate = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = ZonaResource::collection($paginateDate);

            return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function statusZona()
    {
        try {
            $zonaHijau = Zona::where('nama_zona', 'Zona Hijau')->count();
            $zonaKuning = Zona::where('nama_zona', 'Zona Kuning')->count();
            $zonaMerah = Zona::where('nama_zona', 'Zona Merah')->count();
            $totalZona = Zona::count();

            $records = [
                [
                    'zona_hijau' => $zonaHijau,
                    'zona_kuning' => $zonaKuning,
                    'zona_merah' => $zonaMerah,
                    'Total_zona' => $totalZona,
                ]
            ];

            return ApiResponse::success($records, 'Successfully get Data');
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ZonaRequest $request)
    {
        try {
            $zona = Zona::create($request->validated());

            return ApiResponse::created($zona);
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
