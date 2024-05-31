<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;
use App\Http\Requests\PengunjungRequest;
use App\Helpers\ApiResponse;
use Exception;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $query = Pengunjung::with(['provinsi', 'kota', 'wbpProfile']);
            $filterableColumns = [
                'pengunjung_id' => 'id',
                'nama' => 'nama',
                'tempat_lahir' => 'tempat_lahir',
                'tanggal_lahir' => 'tanggal_lahir',
                'jenis_kelamin' => 'jenis_kelamin',
                'provinsi_id' => 'provinsi_id',
                'kota_id' => 'kota_id',
                'alamat' => 'alamat',
                'wbp_profile_id' => 'wbp_profile_id',
                'hubungan_wbp' => 'hubungan_wbp',
                'nik' => 'nik'
            ];
            foreach ($filterableColumns as $requestKey => $column) {
                if ($value = request($requestKey)) {
                    $query->where($column, 'like', '%' . $value . '%');
                }
            }

            $query->latest();
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
    public function store(PengunjungRequest $request)
    {
        try {
            $pengunjung =  new Pengunjung([
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'provinsi_id' => $request->provinsi_id,
                'kota_id' => $request->kota_id,
                'alamat' => $request->alamat,
                'foto_wajah' => $request->foto_wajah,
                'wbp_profile_id' => $request->wbp_profile_id,
                'hubungan_wbp' => $request->hubungan_wbp,
                'nik' => $request->nik,
                'foto_wajah_fr' => $request->foto_wajah_fr
            ]);

            if ($request->hasFile('foto_wajah')) {
                $gambarPath = $request->file('foto_wajah')->store('public/pengunjung_image');
                $pengunjung->foto_wajah = str_replace('public/', '', $gambarPath);
            }

            $pengunjung->save();

            return ApiResponse::created($pengunjung);
        } catch (Exception $e) {
            return ApiResponse::error('Failed to save Data.', $e->getMessage());
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
    public function update(PengunjungRequest $request)
    {
        try {
            $id = $request->input('id');
            $pengunjung = Pengunjung::findOrfail($id);
            if (!$pengunjung) {
                return ApiResponse::error('Data not found.', 'Data not found.', 404);
            }
            $pengunjung->nama = $request->nama;
            $pengunjung->tempat_lahir = $request->tempat_lahir;
            $pengunjung->tanggal_lahir = $request->tanggal_lahir;
            $pengunjung->jenis_kelamin = $request->jenis_kelamin;
            $pengunjung->provinsi_id = $request->provinsi_id;
            $pengunjung->kota_id = $request->kota_id;
            $pengunjung->alamat = $request->alamat;
            $pengunjung->wbp_profile_id = $request->wbp_profile_id;
            $pengunjung->hubungan_wbp = $request->hubungan_wbp;
            $pengunjung->nik = $request->nik;
            $pengunjung->foto_wajah_fr = $request->foto_wajah_fr;

            if ($request->hasFile('foto_wajah')) {
                $gambarPath = $request->file('foto_wajah')->store('public/pengunjung_image');
                $pengunjung->foto_wajah = str_replace('public/', '', $gambarPath);
            }

            $pengunjung->save();


            return ApiResponse::updated($pengunjung);
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update Data.', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('pengunjung_id');
            $pengunjung = Pengunjung::findOrfail($id);
            if (!$pengunjung) {
                return ApiResponse::error('Data not found.', 'Data not found.', 404);
            }
            $pengunjung->delete();
            return ApiResponse::deleted();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete Data.', $e->getMessage());
        }
    }
}
