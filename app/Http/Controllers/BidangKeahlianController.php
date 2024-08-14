<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Requests\BidangKeahlianRequest;
use App\Http\Resources\BidangKeahlianResource;
use App\Models\BidangKeahlian;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class BidangKeahlianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = BidangKeahlian::query();
            $filterableColumns = [
                'bidang_keahlian_id' => 'id',
                'nama_bidang_keahlian' => 'nama_bidang_keahlian',
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
                }
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = BidangKeahlianResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection);

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
    public function store(BidangKeahlianRequest $request)
    {
        try {
            $bidangKeahlian = BidangKeahlian::create($request->validated());

            return ApiResponse::created($bidangKeahlian);
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch(Exception $e) {
            return ApiResponse::error('An unexpected error occurred.', $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->input('id');
        $bidangKeahlian = BidangKeahlian::findOrFail($id);
        return response()->json($bidangKeahlian, 200);
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
    public function update(BidangKeahlianRequest $request)
    {
        $id = $request->input('id');
        $bidangKeahlian = BidangKeahlian::findOrFail($id);

        $existingBidangKeahlian = BidangKeahlian::where('nama_bidang_keahlian', $bidangKeahlian->nama_bidang_keahlian)->first();

        if ($existingBidangKeahlian && $existingBidangKeahlian->id !== $id) {
            return ApiResponse::error('Nama bidang keahlian sudah ada.', null, 422);
        }

        $bidangKeahlian->update($request->all());
        return ApiResponse::updated($bidangKeahlian);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $bidangKeahlian = BidangKeahlian::findOrFail($id);
        $bidangKeahlian->delete();

        return ApiResponse::deleted();
    }

    public function restore($id){
        $bidangKeahlian = BidangKeahlian::withTrashed()->findOrFail($id);
        $bidangKeahlian->restore();

        return response()->json($bidangKeahlian);
    }
}
