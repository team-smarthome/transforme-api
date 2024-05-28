<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangBuktiKasus;
use App\Http\Requests\BarangBuktiKasusRequest;
use App\Helpers\ApiResponse;
use Exception;

class BarangBuktiKasusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (request('barang_bukti_kasus_id')) {
                $query = BarangBuktiKasus::with(['kasus', 'jenisPerkara'])
                    ->where('id', request('barang_bukti_kasus_id'));
                if (request('kasus_id') && $query->exists()) {
                    $query->where('kasus_id', 'like', '%' . request('kasus_id') . '%');
                    if (request('nama_bukti_kasus') && $query->exists()) {
                        $query->where('nama_bukti_kasus', 'like', '%' . request('nama_bukti_kasus') . '%');
                        if (request('nomor_barang_bukti') && $query->exists()) {
                            $query->where('nomor_barang_bukti', 'like', '%' . request('nomor_barang_bukti') . '%');
                            if (request('jenis_perkara_id') && $query->exists()) {
                                $query->where('jenis_perkara_id', 'like', '%' . request('jenis_perkara_id') . '%');
                            }   
                        }
                    } 
                 }
            } elseif(request('kasus_id')) {
                $query = BarangBuktiKasus::with(['kasus', 'jenisPerkara'])
                    ->where('kasus_id', 'like', '%' . request('kasus_id') . '%')->latest();
                if (request('nama_bukti_kasus') && $query->exists()) {
                    $query->where('nama_bukti_kasus', 'like', '%' . request('nama_bukti_kasus') . '%');
                    if (request('nomor_barang_bukti') && $query->exists()) {
                        $query->where('nomor_barang_bukti', 'like', '%' . request('nomor_barang_bukti') . '%');
                        if (request('jenis_perkara_id') && $query->exists()) {
                            $query->where('jenis_perkara_id', 'like', '%' . request('jenis_perkara_id') . '%');
                        }   
                    }
                } 
            } elseif(request('nama_bukti_kasus')) {
                $query = BarangBuktiKasus::with(['kasus', 'jenisPerkara'])
                    ->where('nama_bukti_kasus', 'like', '%' . request('nama_bukti_kasus') . '%')->latest();
                if (request('nomor_barang_bukti') && $query->exists()) {
                    $query->where('nomor_barang_bukti', 'like', '%' . request('nomor_barang_bukti') . '%');
                    if (request('jenis_perkara_id') && $query->exists()) {
                        $query->where('jenis_perkara_id', 'like', '%' . request('jenis_perkara_id') . '%');
                    }   
                }
            } elseif(request('nomor_barang_bukti')) {
                $query = BarangBuktiKasus::with(['kasus', 'jenisPerkara'])
                    ->where('nomor_barang_bukti', 'like', '%' . request('nomor_barang_bukti') . '%')->latest();
                if (request('jenis_perkara_id') && $query->exists()) {
                    $query->where('jenis_perkara_id', 'like', '%' . request('jenis_perkara_id') . '%');
                }   
            } elseif(request('jenis_perkara_id')) {
                $query = BarangBuktiKasus::with(['kasus', 'jenisPerkara'])
                    ->where('jenis_perkara_id', 'like', '%' . request('jenis_perkara_id') . '%')->latest();

            } else {
                $query = BarangBuktiKasus::with(['kasus', 'jenisPerkara'])->latest();
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
    public function store(BarangBuktiKasusRequest $request)
    {
        $barangBuktiKasus = new BarangBuktiKasus([
            'kasus_id' => $request->kasus_id,
            'nama_bukti_kasus' => $request->nama_bukti_kasus,
            'nomor_barang_bukti' => $request->nomor_barang_bukti,
            'keterangan' => $request->keterangan,
            'tanggal_diambil' => $request->tanggal_diambil,
            'longitude' => $request->longitude,
            'jenis_perkara_id' => $request->jenis_perkara_id,
        ]);
        if ($request->hasFile('dokumen_barang_bukti')) {
            $dokumenPath = $request->file('dokumen_barang_bukti')->store('public/barang_bukti_kasus_file');
            $barangBuktiKasus->dokumen_barang_bukti = str_replace('public/', '', $dokumenPath);
        }
        if ($request->hasFile('gambar_barang_bukti')) {
            $gambarPath = $request->file('gambar_barang_bukti')->store('public/barang_bukti_kasus_image');
            $barangBuktiKasus->gambar_barang_bukti = str_replace('public/', '', $gambarPath);
        }
        if ($barangBuktiKasus->save()) {
            return ApiResponse::created($barangBuktiKasus);
        } else {
            return ApiResponse::error('Failed to create data.', 500);
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
    public function update(BarangBuktiKasusRequest $request)
    {
        $id = $request->input('barang_bukti_kasus_id');
        $barangBuktiKasus = BarangBuktiKasus::findOrFail($id);

        // $barangBuktiKasus->kasus_id = $request->kasus_id;
        // $barangBuktiKasus->nama_bukti_kasus = $request->nama_bukti_kasus;
        // $barangBuktiKasus->nomor_barang_bukti = $request->nomor_barang_bukti;
        // $barangBuktiKasus->keterangan = $request->keterangan;
        // $barangBuktiKasus->tanggal_diambil = $request->tanggal_diambil;
        // $barangBuktiKasus->longitude = $request->longitude;
        // $barangBuktiKasus->jenis_perkara_id = $request->jenis_perkara_id;

        if ($request->hasFile('dokumen_barang_bukti')) {
            $dokumenPath = $request->file('dokumen_barang_bukti')->store('public/barang_bukti_kasus');
            $barangBuktiKasus->dokumen_barang_bukti = str_replace('public/', '', $dokumenPath);
        }

        if ($request->hasFile('gambar_barang_bukti')) {
            $gambarPath = $request->file('gambar_barang_bukti')->store('public/barang_bukti_kasus');
            $barangBuktiKasus->gambar_barang_bukti = str_replace('public/', '', $gambarPath);
        }

        if ($barangBuktiKasus->save()) {
            return ApiResponse::updated($barangBuktiKasus);
        } else {
            return ApiResponse::error('Failed to update data.', 500);
        
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('barang_bukti_kasus_id');
            $barangBuktiKasus = BarangBuktiKasus::findOrFail($id);
            if ($barangBuktiKasus->delete()) {
                return ApiResponse::deleted();
            } else {
                return ApiResponse::error('Failed to delete data.', 500);
            }
        } catch (QueryException $e) {
            return ApiResponse::error('Database error', $e->getMessage(), 500);

        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error occurred', $e->getMessage(), 500);
        }

    }
}
