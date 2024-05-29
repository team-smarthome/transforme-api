<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Kasus;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\KasusResource;

class KasusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategori_perkara = $request->input('kategori_perkara_id');
        $jenis_perkara = $request->input('jenis_perkara_id');
        $perPage = $request->input('per_page', 10);

        if ($request->has('kasus_id')) {
            $kasus = Kasus::findOrFail($request->kasus_id);
            return response()->json($kasus, 200);
        }

        if ($request->has('nama_kasus')) {
            $findData = Kasus::with('kategoriPerkara', 'jenisPerkara')->where('nama_kasus', 'like', '%', $request->nama_kasus . '%');
        }

        $paginatedData = $findData->paginate($perPage);

        return ApiResponse::success([
            'data' => KasusResource::collection($paginatedData),
            'pagination' => [
                'total' => $paginatedData->total(),
                'per_page' => $paginatedData->perPage(),
                'current_page' => $paginatedData->currentPage(),
                'last_page' => $paginatedData->lastPage(),
                'from' => $paginatedData->firstItem(),
                'to' => $paginatedData->lastItem(),
            ]
        ]);
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
            'nama_kasus' => 'required|string|max:100',
            'nomor_kasus' => 'required|string|max:100',
            'wbp_profile_id' => 'required|string|max:100',
            'kategori_perkara_id' => 'required|string|max:100',
            'jenis_perkara_id' => 'required|string|max:100',
            'lokasi_kasus' => 'required|string|max:100',
            'waktu_kejadian' => 'nullable|date_format:H:i', // format waktu (jam dan menit)
            'tanggal_pelimpahan_kasus' => 'nullable|date', // format tanggal
            'waktu_pelaporan_kasus' => 'nullable|date_format:H:i', // format waktu (jam dan menit)
            'zona_waktu' => 'required|string|max:100',
            'tanggal_mulai_penyidikan' => 'nullable|date', // format tanggal
            'tanggal_mulai_sidang' => 'nullable|date', // format tanggal
        ]);

        $kasus = Kasus::create($request->all());
        return ApiResponse::success([
            'data' => new KasusResource($kasus)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->input('id');
        $kasus = Kasus::findOrFail($id);
        return response()->json($kasus, 200);
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
        $id = $request->input('id');
        $kasus = Kasus::findOrFail($id);

        $existingKasus = Kasus::where('nama_kasus', $kasus->nama_kasus)->first();

        if($existingKasus && $existingKasus->id !== $id){
            return ApiResponse::error('Nama kasus sudah ada.', null, 422);
        }

        $kasus->update($request->all());
        return ApiResponse::success([
            'data' => new KasusResource($kasus)
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $kasus = Kasus::findOrFail($id);
        $kasus->delete();

        return ApiResponse::deleted();
    }

    public function restore($id){
        $kasus = Kasus::withTrashed()->findOrFail($id);
        $kasus->restore();

        return response()->json($kasus);
    }
}
