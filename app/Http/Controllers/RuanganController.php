<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\RuanganOtmil;
class RuanganController extends Controller
{
    public function index(Request $request)
    {
        try {
            $keyword = $request->input('search');

            $getData = RuanganOtmil::with(['lokasiOtmil', 'lantaiOtmil'])
            ->where('nama_ruangan_otmil', 'LIKE', '%' . $keyword . '%')
            ->orWhereHas('lantaiOtmil', function ($q) use ($keyword){
                $q ->where('nama_lantai', 'LIKE', '%' . $keyword . '%');
            })->orWhereHas('lokasiOtmil', function ($r) use ($keyword){
                $r ->where('nama_lokasi_otmil', 'LIKE', '%' . $keyword . '%');
            })->get();
            
            return ApiResponse::success($getData);
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred while fetching data.', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_ruangan_otmil' => 'required|string',
                'jenis_ruangan_otmil' => 'required|string',
                'lokasi_otmil_id' => 'required|string',
                'lantai_otmil_id' => 'required|string',
                'zona_id' => 'required|string',
                'panjang' => 'nullable',
                'lebar' => 'nullable',
                'posisi_X' => 'nullable',
                'posisi_Y' => 'nullable'
             ]);
             $insert = RuanganOtmil::create($request->all());
            return ApiResponse::success([
            'data' => $insert
        ]);
    } catch (\Exception $e) {
            return ApiResponse::error('An error occurred while fetching data.', $e->getMessage());
        }
    }

    public function show(Request $request)
    {
        $ruangan_otmil_id = $request->input('ruangan_otmil_id');
        $dataRuangan = RuanganOtmil::where('id', $ruangan_otmil_id)->firstOrFail();

        return ApiResponse::success([
            'data' => $dataRuangan
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_ruangan_otmil' => 'required|string',
            'jenis_ruangan_otmil' => 'required|string',
            'lokasi_otmil_id' => 'required|string',
            'lantai_otmil_id' => 'required|string',
            'zona_id' => 'required|string',
            'panjang' => 'nullable',
            'lebar' => 'nullable',
            'posisi_X' => 'nullable',
            'posisi_Y' => 'nullable'
         ]);
         $ruangan_otmil_id = $request->input('id');
         $findLantai = RuanganOtmil::where('id', $ruangan_otmil_id)->firstOrFail();
         $findLantai->nama_ruangan_otmil = $request->input('nama_ruangan_otmil');
         $findLantai->lokasi_otmil_id = $request->input('lokasi_otmil_id');
         $findLantai->jenis_ruangan_otmil = $request->input('jenis_ruangan_otmil');
         $findLantai->lantai_otmil_id = $request->input('lantai_otmil_id');
         $findLantai->zona_id = $request->input('zona_id');
         $findLantai->panjang = $request->input('panjang');
         $findLantai->lebar = $request->input('lebar');
         $findLantai->posisi_X = $request->input('posisi_X');
         $findLantai->posisi_Y = $request->input('posisi_Y');
 
         $findLantai->save();
         return ApiResponse::updated();
    }

    public function destroy(Request $request)
    {
        $ruangan_otmil_id = $request->input('id');
        $ruangan_otmil = RuanganOtmil::findOrFail($ruangan_otmil_id);
        $ruangan_otmil->delete();
    
        return ApiResponse::deleted();   
    }
}
