<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LantaiLemasmil;
use App\Http\Requests\LantaiLemasmilRequest;
use App\Http\Resources\LantaiLemasmilResource;
use App\Helpers\ApiResponse;
use Exception;

class LantaiLemasmilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = LantaiLemasmil::with(['lokasiLemasmil', 'gedungLemasmil']);

            $filterableColumns = [
                'lantai_lemasmil_id' => 'id',
                'nama_lantai' => 'nama_lantai',
                'panjang' => 'panjang',
                'lebar' => 'lebar',
                'posisi_X' => 'posisi_X',
                'posisi_Y' => 'posisi_Y',
                'lokasi_lemasmil_id' => 'lokasi_lemasmil_id',
                'gedung_lemasmil_id' => 'gedung_lemasmil_id',
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
                }
            }

            $query->latest();

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = LantaiLemasmilResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection);

            // if (request('lantai_lemasmil_id')) {
            //     $query = LantaiLemasmil::with(["lokasiLemasmil", "gedungLemasmil"]) 
            //     ->where('id', request('lantai_lemasmil_id'));
            //     if(request('nama_lantai') && $query->exists()) {
            //         $query->where('nama_lantai', 'like', '%' . request('nama_lantai') . '%');
            //         if(request('lokasi_lemasmil_id') && $query->exists()) {
            //             $query->where('lokasi_lemasmil_id', 'like', '%' . request('lokasi_lemasmil_id') . '%');
            //             if(request('gedung_lemasmil_id') && $query->exists()) {
            //                 $query->where('gedung_lemasmil_id', 'like', '%' . request('gedung_lemasmil_id') . '%');
            //             }
            //         }
            //     }
            // } elseif(request('nama_lantai')) {
            //     $query = LantaiLemasmil::with(["lokasiLemasmil", "gedungLemasmil"]) 
            //     ->where('nama_lantai', 'like', '%' . request('nama_lantai') . '%')->latest();
            //     if(request('lokasi_lemasmil_id') && $query->exists()) {
            //         $query->where('lokasi_lemasmil_id', 'like', '%' . request('lokasi_lemasmil_id') . '%');
            //         if(request('gedung_lemasmil_id') && $query->exists()) {
            //             $query->where('gedung_lemasmil_id', 'like', '%' . request('gedung_lemasmil_id') . '%');
            //         }
            //     }
            // } elseif(request('lokasi_lemasmil_id')) {
            //     $query = LantaiLemasmil::with(["lokasiLemasmil", "gedungLemasmil"]) 
            //     ->where('lokasi_lemasmil_id', 'like', '%' . request('lokasi_lemasmil_id') . '%')->latest();
            //     if(request('gedung_lemasmil_id') && $query->exists()) {
            //         $query->where('gedung_lemasmil_id', 'like', '%' . request('gedung_lemasmil_id') . '%');
            //     }
            // } elseif(request('gedung_lemasmil_id')) {
            //     $query = LantaiLemasmil::with(["lokasiLemasmil", "gedungLemasmil"]) 
            //     ->where('gedung_lemasmil_id', 'like', '%' . request('gedung_lemasmil_id') . '%')->latest();
            // } else {
            //     $query = LantaiLemasmil::with(["lokasiLemasmil", "gedungLemasmil"])->latest();
            // }

            // return ApiResponse::paginate($query);
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
    public function store(LantaiLemasmilRequest $request)
    {
        try {
            $lemasmilLantai = new LantaiLemasmil([
                'nama_lantai' => $request->nama_lantai,
                'panjang' => $request->panjang,
                'lebar' => $request->lebar,
                'posisi_X' => $request->posisi_X,
                'posisi_Y' => $request->posisi_Y,
                'lokasi_lemasmil_id' => $request->lokasi_lemasmil_id,
                'gedung_lemasmil_id' => $request->gedung_lemasmil_id,
            ]);

            if (LantaiLemasmil::where('nama_lantai', $request->nama_lantai)->exists()) {
                return ApiResponse::error('Data already exists', 'Data with Nama Lantai ' . $request->nama_lantai . ' already exists', 400);
            }

           if ($lemasmilLantai->save()) {
                $data = $lemasmilLantai->toArray();
                $formattedData = array_merge(['id' => $lemasmilLantai->id], $data);
                return ApiResponse::created($formattedData);
            } else {
                return ApiResponse::error('Failed to create Data.', 'Failed to create Data.', 500);
            }
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
    public function update(LantaiLemasmilRequest $request)
    {
        try {
            $id = $request->input('lantai_lemasmil_id');
            $lemasmilLantai = LantaiLemasmil::findOrFail($id);
            $lemasmilLantai->nama_lantai = $request->nama_lantai;
            $lemasmilLantai->panjang = $request->panjang;
            $lemasmilLantai->lebar = $request->lebar;
            $lemasmilLantai->posisi_X = $request->posisi_X;
            $lemasmilLantai->posisi_Y = $request->posisi_Y;
            $lemasmilLantai->lokasi_lemasmil_id = $request->lokasi_lemasmil_id;
            $lemasmilLantai->gedung_lemasmil_id = $request->gedung_lemasmil_id;

            if ($lemasmilLantai->save()) {
                $data = $lemasmilLantai->toArray();
                $formattedData = array_merge(['id' => $lemasmilLantai->id], $data);
                return ApiResponse::updated($formattedData);    
            } else {
                return ApiResponse::error('Failed to update Data.', 'Failed to update Data.', 500);
            }
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
    
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('lantai_lemasmil_id');
            $lemasmilLantai = LantaiLemasmil::findOrFail($id);
            if ($lemasmilLantai->delete()) {
                return ApiResponse::deleted();
            } else {
                return ApiResponse::error('Failed to delete data.', 'Failed to delete data.', 500);
            }
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);
    
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }
    }
}
