<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Requests\ZonaRequest;
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
            if (request('search')) {
                $keyword = $request->input('search');
                $query = Zona::where('nama_zona','LIKE','%'. $keyword . '%')->latest();
            } else{
                $query = Zona::latest();
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
