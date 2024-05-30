<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sidang;
use App\Http\Requests\SidangRequest;
use App\Helpers\ApiResponse;



class SidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // $sidang = Sidang::with('oditurPenuntut')->get();
            // return [
            //     'status' => 'OK',
            //     'message' => 'Data sidang berhasil diambil',
            //     'data' => $sidang
            // ];
            $query = Sidang::with('oditurPenuntut');
            $filterableColumns = [
                'sidang_id' => 'id',
                'nama_sidang' => 'nama_sidang',
                'kasus_id' => 'kasus_id',                
            ];
            foreach ($filterableColumns as $requestKey => $column) {
                if ($value = request($requestKey)) {
                    $query->where($column, 'like', '%' . $value . '%');
                }
            }

            $query->latest();
            return ApiResponse::paginate($query);
        } catch (\Exception $e) {
            return [
                'status' => 'ERROR',
                'message' => 'Data sidang gagal diambil',
                'data' => $e->getMessage()
            ];
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
