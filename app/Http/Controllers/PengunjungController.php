<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;
use App\Http\Requests\PengunjungRequest;
use App\Helpers\ApiResponse;
use App\Http\Resources\PengunjungResource;
use Exception;
use Ramsey\Uuid\Uuid;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Pengunjung::with(['provinsi', 'kota', 'wbpProfile']);
            $filterableColumns = [
                'nama' => 'nama',
                'alamat' => 'alamat',
                'wbp_profile_id' => 'wbp_profile_id',
                'nama_wbp' => 'wbpProfile.nama',
                'nik' => 'nik'
            ];


            foreach ($filterableColumns as $requestKey => $column) {
                if ($request->has($requestKey)) {
                    $query->where($column, 'like', '%' . $request->input($requestKey) . '%');
                }
            }

            if ($request->has('nama_wbp')) {
                $query->whereHas('wbpProfile', function ($q) use ($request) {
                    $q->where('nama_wbp', 'like', '%' . $request->input('nama_wbp') . '%');
                });
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = PengunjungResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
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
        $uuid = Uuid::uuid4()->toString();
        $base64Image = $request['foto_wajah'];
        $image = Helpers::HandleImageToBase64($base64Image, 'pengunjung_image');
        try {
            DB::beginTransaction();
            $pengunjung =   Pengunjung::create([
                'id' => $uuid,
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'provinsi_id' => $request->provinsi_id,
                'kota_id' => $request->kota_id,
                'alamat' => $request->alamat,
                'foto_wajah' => $image,
                'wbp_profile_id' => $request->wbp_profile_id,
                'hubungan_wbp' => $request->hubungan_wbp,
                'nik' => $request->nik,
                'foto_wajah_fr' => $base64Image,
            ]);
            DB::commit();
            return response()->json([
                'status' => 'OK',
                'message' => 'Successfully created data.',
            ], 200);

            // if ($request->hasFile('foto_wajah')) {
            //     $gambarPath = $request->file('foto_wajah')->store('public/pengunjung_image');
            //     $pengunjung->foto_wajah = str_replace('public/', '', $gambarPath);
            // }

            // $pengunjung->save();

            // return ApiResponse::created($pengunjung);
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
            // DB::beginTransaction();
            // $findPengunjung = Pengunjung::where('id', $request['pengunjung_id'])->first();
            // $image = $request['foto_wajah'];
            // if (strpos($image, 'data:image/') === 0 && $image != $findPengunjung->foto_wajah) {
            //     $image = Helpers::HandleImageToBase64($image, 'pengunjung-image');
            // }
            // $data_foto_wajah_fr = $request['foto_wajah'] == $findPengunjung->foto_wajah_fr ? $findPengunjung->foto_wajah_fr : $request['foto_wajah'];
            $id = $request->input('pengunjung_id');
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

            // if ($request->hasFile('foto_wajah')) {
            //     $gambarPath = $request->file('foto_wajah')->store('public/pengunjung_image');
            //     $pengunjung->foto_wajah = str_replace('public/', '', $gambarPath);
            // }

            $pengunjung->save();

            // $updatePengujung = Pengunjung::where('id', $request['pengunjung_id'])
            // ->update([
            // 'nama' => $request['nama'],
            // 'tempat_lahir' => $request['tempat_lahir'],
            // 'tanggal_lahir' => $request['tanggal_lahir'],
            // 'jenis_kelamin' => $request['jenis_kelamin'],
            // 'provinsi_id' => $request['provinsi_id'],
            // 'kota_id' => $request['kota_id'],
            // 'alamat' => $request['alamat'],
            // 'wbp_profile_id' => $request['wbp_profile_id'],
            // 'hubungan_wbp' => $request['hubungan_wbp'],
            // 'nik' => $request['nik'],
            // 'foto_wajah' => $image,
            // 'foto_wajah_fr' => $data_foto_wajah_fr,
            // ]);
            // DB::commit();
            // return response()->json([
            //     'status' => 'OK',
            //     'message' => 'Successfully updated data.',
            // ], 201);


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
