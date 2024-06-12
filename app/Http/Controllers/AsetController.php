<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aset;
use App\Http\Requests\AsetRequest;
use App\Http\Resources\AsetResource;
use App\Helpers\ApiResponse;
use Exception;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Aset::with(['tipeAset', 'ruanganOtmil', 'ruanganLemasmil']);
            $filterableColumns = [
                'nama_tipe' => 'tipeAset.nama_tipe',
                'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan',
                'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan',
                'kondisi' => 'kondisi',
                'tanggal_masuk' => 'tanggal_masuk',
                'serial_number' => 'serial_number',
                'model' => 'model',
                'merek' => 'merek',
            ];
            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    if($requestKey === 'nama_tipe'){
                        $query->whereHas('tipeAset', function($q) use($filters, $requestKey){
                            $q->where('nama_tipe', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    }
                    else{
                        $query->where($column, 'LIKE', '%' . $filters[$requestKey] . '%');
                    }
                }
             }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = AsetResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection);
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
    public function store(AsetRequest $request)
    {
        try {
            $aset =  new Aset([
                'nama_aset' => $request->nama_aset,
                'tipe_aset_id' => $request->tipe_aset_id,
                'ruangan_otmil_id' => $request->ruangan_otmil_id,
                'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
                'kondisi' => $request->kondisi,
                'keterangan' => $request->keterangan,
                'tanggal_masuk' => $request->tanggal_masuk,
                'serial_number' => $request->serial_number,
                'model' => $request->model,
                'image' => $request->image,
                'merek' => $request->merek,
                'garansi' => $request->garansi
            ]);

            if (Aset::where('nama_aset', $request->nama_aset)->exists()) {
                return ApiResponse::error('Failed to create Aset.', 'Aset already exists.');
            }

            if ($request->hasFile('image')) {
                $gambarPath = $request->file('image')->store('public/aset_image');
                $aset->image = str_replace('public/', '', $gambarPath);
            }

            if ($aset->save()) {
                return ApiResponse::created($aset);
            } else {
                return ApiResponse::error('Failed to create Aset.', 'Unknown error.');
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create Aset.', $e->getMessage());
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
    public function update(AsetRequest $request)
    {
        try {
            $id = $request->input('aset_id');
            $aset = Aset::find($id);
            if (!$aset) {
                return ApiResponse::error('Failed to update Aset.', 'Aset not found.');
            }

            $aset->nama_aset = $request->nama_aset;
            $aset->tipe_aset_id = $request->tipe_aset_id;
            $aset->ruangan_otmil_id = $request->ruangan_otmil_id;
            $aset->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $aset->kondisi = $request->kondisi;
            $aset->keterangan = $request->keterangan;
            $aset->tanggal_masuk = $request->tanggal_masuk;
            $aset->serial_number = $request->serial_number;
            $aset->model = $request->model;
            $aset->image = $request->image;
            $aset->merek = $request->merek;
            $aset->garansi = $request->garansi;

            if ($request->hasFile('image')) {
                $gambarPath = $request->file('image')->store('public/aset_image');
                $aset->image = str_replace('public/', '', $gambarPath);
            }
            if ($aset->save()) {
                return ApiResponse::updated($aset);
                return ApiResponse::error('Failed to update Aset.', 'Unknown error.');
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update Aset.', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('aset_id');
            $aset = Aset::find($id);
            if (!$aset) {
                return ApiResponse::error('Failed to delete Aset.', 'Aset not found.');
            }

            if ($aset->delete()) {
                return ApiResponse::deleted();
            } else {
                return ApiResponse::error('Failed to delete Aset.', 'Unknown error.');
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete Aset.', $e->getMessage());
        }
    }
}
