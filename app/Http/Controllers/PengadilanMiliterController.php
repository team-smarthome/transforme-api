<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\PengadilanMiliter;
use Illuminate\Database\QueryException;
use Exception;
use App\Http\Requests\PengadilanMiliterRequest;
use App\Http\Resources\PengadilanMiliterResource;

class PengadilanMiliterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = PengadilanMiliter::query();
            $filterData = [
                'nama_pengadilan_militer' => 'nama_pengadilan_militer',
                'nama_provinsi' => 'provinsi.nama_provinsi',
                'nama_kota' => 'kota.nama_kota',
            ];

            // $filters = $request->input('filter', []);

            foreach ($filterData as $requestKey => $column) {
                if ($request->has($requestKey)) {
                    $query->where($column, 'like', '%' . $request->input($requestKey) . '%');
                }
            }

            // foreach ($filterData as $key => $column) {
            //     if (isset($filters[$key])) {
            //         if ($key === 'nama_provinsi') {
            //             $query->whereHas('provinsi', function ($q) use ($filters, $key) {
            //                 $q->where('nama_provinsi', 'LIKE', '%' . $filters[$key] . '%');
            //             });
            //         }
            //         if ($key === 'nama_kota') {
            //             $query->whereHas('kota', function ($q) use ($filters, $key) {
            //                 $q->where('nama_kota', 'LIKE', '%' . $filters[$key] . '%');
            //             });
            //         } else {
            //             $query->where($column, 'LIKE', '%' . $filters[$key] . '%');
            //         }
            //     }
            // }
            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = PengadilanMiliterResource::collection($paginatedData);
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
    public function store(PengadilanMiliterRequest $request)
    {
        try {
            $data = $request->all();
            $pengadilanMiliter = PengadilanMiliter::create($data);
            return ApiResponse::success($pengadilanMiliter, 'Pengadilan Militer created successfully');
        } catch (QueryException $e) {
            return ApiResponse::error('Failed to create Pengadilan Militer.', $e->errorInfo);
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create Pengadilan Militer.', $e->getMessage());
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
    public function update(PengadilanMiliterRequest $request)
    {
        try {
            $id = $request->input('pengadilan_militer_id');
            $pengadilanMiliter = PengadilanMiliter::findOrFail($id);
            $pengadilanMiliter->update($request->all());
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }

        return ApiResponse::updated($pengadilanMiliter);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('pengadilan_militer_id');
            $pengadilanMiliter = PengadilanMiliter::findOrFail($id);
            $pengadilanMiliter->delete();
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
        } catch (Exception $e) {
            return ApiResponse::error('Data has Already delete', $e->getMessage(), 500);
        }
        return ApiResponse::deleted();
    }

    // public function search(Request $request)
    // {
    //     try {
    //         $query = PengadilanMiliter::query();
    //         if ($request->has('nama_pengadilan_militer')) {
    //             $query->where('nama_pengadilan_militer', 'like', '%' . $request->nama_pengadilan_militer . '%');
    //         }
    //         if ($request->has('provinsi_id')) {
    //             $query->where('provinsi_id', $request->provinsi_id);
    //         }
    //         if ($request->has('kota_id')) {
    //             $query->where('kota_id', $request->kota_id);
    //         }
    //         if ($request->has('latitude')) {
    //             $query->where('latitude', $request->latitude);
    //         }
    //         if ($request->has('longitude')) {
    //             $query->where('longitude', $request->longitude);
    //         }
    //         return ApiResponse::paginate($query);
    //     } catch (\Exception $e) {
    //         return ApiResponse::error('Failed to get Data.', $e->getMessage());
    //     }
    // }
}
