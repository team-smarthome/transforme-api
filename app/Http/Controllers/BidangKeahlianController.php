<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Requests\BidangKeahlianRequest;
use App\Models\BidangKeahlian;
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
            if (request('search')) {
                $keyword = $request->input('search');
                $query = BidangKeahlian::where('nama_bidang_keahlian', 'like', '%' . $keyword . '%')->latest();
            } else {
                $query = BidangKeahlian::latest();
            }

            return ApiResponse::paginate($query);
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
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
    public function update(BidangKeahlianRequest $request, string $id)
    {
        $request->validate(['nama_bidang_keahlian' => 'required|string|max:255']);

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
    public function destroy(string $id)
    {
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
