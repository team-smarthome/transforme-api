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
            $query = AktivitasPengunjung::with([
                'ruanganLemasmil.lokasiLemasmil',
                'ruanganOtmil.lokasiOtmil',
                'ruanganLemasmil.zona',
                'ruanganOtmil.zona',
                'petugas',
                'pengunjung',
                'wbpProfile'
            ]);
            $filterableColumns = [
                'lokasi_otmil_id' => 'ruanganOtmil.lokasi_otmil_id',
                'nama_lokasi_otmil' => 'ruanganOtmil.lokasiOtmil.nama_lokasi_otmil',
                'lokasi_lemasmil_id' => 'ruanganLemasmil.lokasi_lemasmil_id',
                'nama_lokasi_lemasmil' => 'ruanganLemasmil.lokasiLemasmil.nama_lokasi_lemasmil',
                'ruangan_otmil_id' => 'ruangan_otmil_id',
                'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
                'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
                'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan_lemasmil',
                'nama_aktivitas_pengunjung' => 'nama_aktivitas_pengunjung',
                'waktu_mulai_kunjungan' => 'waktu_mulai_kunjungan',
                'waktu_selesai_kunjungan' => 'waktu_selesai_kunjungan',
                'tujuan_kunjungan' => 'tujuan_kunjungan',
                'petugas_id' => 'petugas.petugas_id',
                'nama_petugas' => 'petugas.nama',
                'pengunjung_id' => 'pengunjung_id',
                'nama_pengunjung' => 'pengunjung.nama',
                'wbp_profile_id' => 'wbp_profile_id',
                'nama_wbp' => 'wbpProfile.nama',
                'zona_waktu' => 'zona_waktu'
            ];

            $filters = $request->input('filter', []);
            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    if ($requestKey === 'lokasi_otmil_id') {
                        $query->whereHas('ruanganOtmil', function ($q) use ($filters, $requestKey) {
                            $q->where('lokasi_otmil_id', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    }
                    if ($requestKey === 'nama_lokasi_otmil') {
                        $query->whereHas('ruanganOtmil.lokasiOtmil', function ($q) use ($filters, $requestKey) {
                            $q->where('nama_lokasi_otmil', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    }
                    if ($requestKey === 'lokasi_lemasmil_id') {
                        $query->whereHas('ruanganLemasmil', function ($q) use ($filters, $requestKey) {
                            $q->where('lokasi_lemasmil_id', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    }
                    if ($requestKey === 'nama_lokasi_lemasmil') {
                        $query->whereHas('ruanganLemasmil.lokasiLemasmil', function ($q) use ($filters, $requestKey) {
                            $q->where('nama_lokasi_lemasmil', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    }
                    if ($requestKey === 'nama_ruangan_otmil') {
                        $query->whereHas('ruanganOtmil', function ($q) use ($filters, $requestKey) {
                            $q->where('nama_ruangan_otmil', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    }
                    if ($requestKey === 'nama_ruangan_lemasmil') {
                        $query->whereHas('ruanganLemasmil', function ($q) use ($filters, $requestKey) {
                            $q->where('nama_ruangan_lemasmil', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    }
                    if ($requestKey === 'nama_petugas') {
                        $query->whereHas('petugas', function ($q) use ($filters, $requestKey) {
                            $q->where('nama', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    }
                    if ($requestKey === 'nama_wbp') {
                        $query->whereHas('wbpProfile', function ($q) use ($filters, $requestKey) {
                            $q->where('nama', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    }
                    else {
                        $query->where($column, 'LIKE', '%' . $filters[$requestKey] . '%');
                    }
                }
            }

            $query->latest();
            $paginateData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = AktivitasPengunjungResource::collection($paginateData);

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
