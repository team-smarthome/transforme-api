<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\Provinsi;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // if (request('search')) {
            //     $keyword = $request->input('search');
            //     $query = Provinsi::where('nama_provinsi','like','%'. $keyword .'%')->latest();
            // } else {
            //     $query = Provinsi::latest();
            // }
            $query = Provinsi::latest();
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
    public function store(Request $request)
    {
        //
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
