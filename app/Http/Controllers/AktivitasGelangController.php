<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Resources\AktivitasGelangResource;
use App\Models\AktivitasGelang;

class AktivitasGelangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = AktivitasGelang::with(['wbpProfile']);
            $filterableColumns = [
                'gmac' => 'gmac',
                'dmac' => 'dmac',
                'baterai' => 'baterai',
                'step' => 'step',
                'heartrate' => 'heartrate',
                'temp' => 'temp',
                'spo' => 'spo',
                'systolic' => 'systolic',
                'diastolic' => 'diastolic',
                'cutoff_flag' => 'cutoff_flag',
                'type' => 'type',
                'x0' => 'x0',
                'y0' => 'y0',
                'z0' => 'z0',
                'wbp_profile_id' => 'wbp_profile_id',
                'rssi' => 'rssi',
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
                }
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = AktivitasGelangResource::collection($paginatedData);
            return ApiResponse::pagination($resourceCollection);

        } catch (\Exception $e) {
            return ApiResponse::error($e);
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
        $request->validate([
            'gmac' => 'required|string|max:255',
            'dmac'=> 'required|string|max:255',
            'baterai'=> 'required|string|max:255',
            'step'=> 'required|string|max:255',
            'heartrate'=> 'required|string|max:255',
            'temp'=> 'required|string|max:255',
            'spo'=> 'required|string|max:255',
            'systolic'=> 'required|string|max:255',
            'diastolic'=> 'required|string|max:255',
            'cutoff_flag'=> 'required|',
            'type'=> 'required|string|max:255',
            'x0'=> 'required|string|max:255',
            'y0'=> 'required|string|max:255',
            'z0'=> 'required|string|max:255',
            'wbp_profile_id'=> 'required|string|max:255',
            'rssi'=> 'required|string|max:255',
        ]);

        $aktivitasGelang = AktivitasGelang::create($request->all());

        return ApiResponse::success(['data'=> new AktivitasGelangResource($aktivitasGelang)]);
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
