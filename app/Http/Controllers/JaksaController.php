<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Requests\JaksaRequest;
use App\Http\Resources\JaksaResource;
use App\Models\Jaksa;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Exception;

class JaksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // if ($request->has('jaksa_id')) {
            //     $jaksa = Jaksa::findOrFail($request->jaksa_id);
            //     return response()->json($jaksa, 200);
            // }

            // if ($request->has('nama_jaksa')) {
            //     $query = Jaksa::where('nama_jaksa','like','%'. $request->nama_jaksa .'%')->latest();
            // } else {
            //     $query = Jaksa::latest();
            // }

            // return ApiResponse::paginate($query);
            $query = Jaksa::query();
            $filterableColumns = [
                'jaksa_id' => 'id',
                'nrp_jaksa' => 'nrp_jaksa',
                'nama_jaksa' => 'nama_jaksa',
                'alamat' => 'alamat',
                'nomor_telepon' => 'nomor_telepon',
                'email' => 'email',
                'jabatan' => 'jabatan',
                'spesialisasi_hukum' => 'spesialisasi_hukum',
                'divisi' => 'divisi',
                'tanggal_pensiun' => 'tanggal_pensiun'
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    $query->where($column, 'like', '%' . $filters[$requestKey] .'%');
                }
            }

            $query->latest();
            $paginateData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = JaksaResource::collection($paginateData);

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
    public function store(JaksaRequest $request)
    {
        try {
            $jaksa = Jaksa::create($request->validated());
            return ApiResponse::created($jaksa);
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->input('id');
        $jaksa = Jaksa::findOrFail($id);
        return response()->json($jaksa, 200);
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
    public function update(JaksaRequest $request)
    {
        $id = $request->input('id');
        $jaksa = Jaksa::findOrFail($id);

        $existingJaksa = Jaksa::where('nama_jaksa', $jaksa->nama_jaksa)->first();

        if ($existingJaksa && $existingJaksa->id !== $id) {
            return ApiResponse::error('Nama jaksa sudah ada.', null, 422);
        }

        $jaksa->update($request->all());
        return ApiResponse::updated($jaksa);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $jaksa = Jaksa::findOrFail($id);
        $jaksa->delete();

        return ApiResponse::deleted();
    }

    public function restore($id){
        $jaksa = Jaksa::withTrashed()->findOrFail($id);
        $jaksa->restore();

        return response()->json($jaksa);
    }
}
