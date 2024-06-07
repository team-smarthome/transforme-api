<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use Exception;
use App\Models\WbpProfile;
use Illuminate\Support\Facades\DB;

class RekapJumlahKasusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = WbpProfile::leftJoin('kasus', 'wbp_profile.kasus_id', '=', 'kasus.id')
                ->leftJoin('kategori_perkara', 'kasus.kategori_perkara_id', '=', 'kategori_perkara.id')
                ->select('kategori_perkara.nama_kategori_perkara', DB::raw('COUNT(kategori_perkara.nama_kategori_perkara) as banyaknya_kasus'))
                ->groupBy('kategori_perkara.nama_kategori_perkara')
                ->orderBy('kategori_perkara.nama_kategori_perkara', 'asc');
            // ->orderBy('created_at', 'desc');

            $filters = $request->input('filter', []);
            if (!empty($filters['nama_kategori_perkara'])) {
                $query->where('kategori_perkara.nama_kategori_perkara', 'like', '%' . $filters['nama_kategori_perkara'] . '%');
            }
            // $filterableColumns = [
            //     'nama_kategori_perkara' => 'kategori_perkara.nama_kategori_perkara'
            // ];

            // foreach ($filterableColumns as $requestKey => $column) {
            //     if ($value = request($requestKey)) {
            //         $query->where($column, 'like', '%' . $value . '%');
            //     }
            // }

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            return ApiResponse::pagination($paginatedData, 'Successfully get Data');
        } catch (Exception $e) {
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
