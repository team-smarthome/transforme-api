<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AktivitasPengunjung;
use App\Http\Requests\AktivitasPengunjungRequest;
use App\Helpers\ApiResponse;
use App\Http\Resources\AktivitasPengunjungResource;
use Exception;


class AktivitasPengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $user = $request->get('user');
            $nama_pengunjung = $request->input('nama_pengunjung');
            $nama_wbp = $request->input('nama_wbp');
            $pageSize = $request->input('pageSize', ApiResponse::$defaultPagination);
            
            $query = AktivitasPengunjung::with([
                'ruanganLemasmil.lokasiLemasmil',
                'ruanganOtmil.lokasiOtmil',
                'ruanganLemasmil.zona',
                'ruanganOtmil.zona',
                'petugas',
                'pengunjung',
                'wbpProfile',
            ])->where(function ($q) use ($nama_pengunjung, $nama_wbp) {
                if ($nama_pengunjung) {
                    $q->orWhereHas('pengunjung', function ($q) use ($nama_pengunjung) {
                        $q->where('nama', 'LIKE', '%' . $nama_pengunjung . '%');
                    });
                }
                if ($nama_wbp) {
                    $q->orWhereHas('wbpProfile', function ($q) use ($nama_wbp) {
                        $q->where('nama', 'LIKE', '%' . $nama_wbp . '%');
                    });
                }
            })->latest()->paginate($pageSize);
    
            $resourceCollection = AktivitasPengunjungResource::collection($query);

            return ApiResponse::pagination($resourceCollection, 'Successfully get data');
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
    public function store(AktivitasPengunjungRequest $request)
    {
        try {
            $aktivitasPengunjung =  new AktivitasPengunjung([
                'aktivitas_pengunjung_id' => $request->aktivitas_pengunjung_id,
                'nama_aktivitas_pengunjung' => $request->nama_aktivitas_pengunjung,
                'waktu_mulai_kunjungan' => $request->waktu_mulai_kunjungan,
                'waktu_selesai_kunjungan' => $request->waktu_selesai_kunjungan,
                'tujuan_kunjungan' => $request->tujuan_kunjungan,
                'ruangan_otmil_id' => $request->ruangan_otmil_id,
                'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
                'petugas_id' => $request->petugas_id,
                'pengunjung_id' => $request->pengunjung_id,
                'wbp_profile_id' => $request->wbp_profile_id,
                'zona_waktu' => $request->zona_waktu
            ]);
            if (AktivitasPengunjung::where('nama_aktivitas_pengunjung', $request->nama_aktivitas_pengunjung)->exists()) {
                return ApiResponse::error('Aktivitas Pengunjung already exists');
            }

            if ($aktivitasPengunjung->save()) {
                return ApiResponse::created($aktivitasPengunjung);
            }

            return ApiResponse::error('Failed to create Aktivitas Pengunjung');
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create Aktivitas Pengunjung', $e->getMessage());
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
    public function update(AktivitasPengunjungRequest $request)
    {
        try {
            $id = $request->input('aktivitas_pengunjung_id');
            $aktivitasPengunjung = AktivitasPengunjung::find($id);
            if (!$aktivitasPengunjung) {
                return ApiResponse::notFound('Aktivitas Pengunjung not found');
            }

            $aktivitasPengunjung->nama_aktivitas_pengunjung = $request->nama_aktivitas_pengunjung;
            $aktivitasPengunjung->waktu_mulai_kunjungan = $request->waktu_mulai_kunjungan;
            $aktivitasPengunjung->waktu_selesai_kunjungan = $request->waktu_selesai_kunjungan;
            $aktivitasPengunjung->tujuan_kunjungan = $request->tujuan_kunjungan;
            $aktivitasPengunjung->ruangan_otmil_id = $request->ruangan_otmil_id;
            $aktivitasPengunjung->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $aktivitasPengunjung->petugas_id = $request->petugas_id;
            $aktivitasPengunjung->pengunjung_id = $request->pengunjung_id;
            $aktivitasPengunjung->wbp_profile_id = $request->wbp_profile_id;
            $aktivitasPengunjung->zona_waktu = $request->zona_waktu;

            if ($aktivitasPengunjung->save()) {
                return ApiResponse::updated($aktivitasPengunjung);
            }

            return ApiResponse::error('Failed to update Aktivitas Pengunjung');
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update Aktivitas Pengunjung', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('aktivitas_pengunjung_id');
            $aktivitasPengunjung = AktivitasPengunjung::find($id);
            if (!$aktivitasPengunjung) {
                return ApiResponse::notFound('Aktivitas Pengunjung not found');
            }

            if ($aktivitasPengunjung->delete()) {
                return ApiResponse::deleted();
            }

            return ApiResponse::error('Failed to delete Aktivitas Pengunjung');
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete Aktivitas Pengunjung', $e->getMessage());
        }
    }
}
