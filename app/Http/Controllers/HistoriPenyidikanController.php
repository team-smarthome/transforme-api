<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\HistoriPenyidikanResource;
use App\Models\HistoriPenyidikan;
use Illuminate\Http\Request;

class HistoriPenyidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = HistoriPenyidikan::with('penyidikan.wbpProfile', 'penyidikan.kasus.jenisPerkara');
            $filterableColumns = [
                'nama_wbp' => 'penyidikan.wbpProfile.nama', 
                'nama_jenis_perkara' => 'penyidikan.kasus.jenisPerkara.nama_jenis_perkara', 
                'hasil_penyidikan' => 'hasil_penyidikan', 
                'lama_masa_tahanan' => 'lama_masa_tahanan'
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    if ($requestKey === 'nama_wbp') {
                        // Handle the relationship filter
                        $query->whereHas('penyidikan.wbpProfile', function ($q) use ($filters, $requestKey) {
                            $q->where('nama', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } else if($requestKey === 'nama_jenis_perkara'){
                        $query->whereHas('penyidikan.kasus.jenisPerkara', function ($q) use ($filters, $requestKey) {
                            $q->where('nama_jenis_perkara', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } else{
                        $query->where($column, 'like', '%' . $filters[$requestKey] .'%');
                    }
                }
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = HistoriPenyidikanResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred while fetching data.', $e->getMessage());
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
            'penyidikan_id' => 'required|string|max:100',
            'hasil_penyidikan' => 'required|string|max:100',
            'lama_masa_tahanan' => 'required|string|max:100'
        ]);

        $data = HistoriPenyidikan::create($request->all());

        return ApiResponse::success([
            'data' => new HistoriPenyidikanResource($data)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $request->validate([
            'histori_penyidikan_id' => 'required|string|max:100',
        ]);

        $histori_penyidikan_id = $request->input('histori_penyidikan_id');
        $data = HistoriPenyidikan::where('id', $histori_penyidikan_id)->firstOrFail();

        return ApiResponse::success(
            new HistoriPenyidikanResource($data)
        );
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
    public function update(Request $request)
    {
        $request->validate([
            'penyidikan_id' => 'required|string|max:100',
            'hasil_penyidikan' => 'required|string|max:100',
            'lama_masa_tahanan' => 'required|string|max:100'
        ]);

        $histori_penyidikan_id = $request->input('histori_penyidikan_id');
        $data = HistoriPenyidikan::where('id', $histori_penyidikan_id)->firstOrFail();
        $data->penyidikan_id = $request->input('penyidikan_id');
        $data->hasil_penyidikan = $request->input('hasil_penyidikan');
        $data->lama_masa_tahanan = $request->input('lama_masa_tahanan');

        $data->save();

        return ApiResponse::updated(
            new HistoriPenyidikanResource($data)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'histori_penyidikan_id' => 'required|string|max:100',
        ]);

        $histori_penyidikan_id = $request->input('histori_penyidikan_id');
        $data = HistoriPenyidikan::where('id', $histori_penyidikan_id)->firstOrFail();
        $data->delete();

        return ApiResponse::deleted(
            new HistoriPenyidikanResource($data)
        );
    }
}
