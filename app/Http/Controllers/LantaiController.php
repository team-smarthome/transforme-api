<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Resources\LantaiOtmilResource;
use App\Models\LantaiOtmil;
class LantaiController extends Controller
{
    //
    public function index(Request $request)
    {
        try {
            // $keyword = $request->input('search');

            // $getData = LantaiOtmil::with(['lokasiOtmil', 'gedungOtmil'])
            // ->where('nama_lantai', 'LIKE', '%' . $keyword . '%')
            // ->orWhereHas('gedungOtmil', function ($q) use ($keyword){
            //     $q ->where('nama_gedung_otmil', 'LIKE', '%' . $keyword . '%');
            // })->orWhereHas('lokasiOtmil', function ($r) use ($keyword){
            //     $r ->where('nama_lokasi_otmil', 'LIKE', '%' . $keyword . '%');
            // })->get();
            
            // return ApiResponse::success([
            //     'data' => $getData
            // ]);

            $query = LantaiOtmil::with(['lokasiOtmil', 'gedungOtmil']);

            $filterableColumns = [
                'nama_lantai' => 'nama_lantai',
                'lokasi_otmil_id' => 'lokasi_otmil_id',
                'gedung_otmil_id' => 'gedung_otmil_id',
            ];

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    $query->where($column, 'like', '%' . $filters[$requestKey] .'%');
                }
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = LantaiOtmilResource::collection($paginatedData);

            return ApiResponse::pagination($resourceCollection);
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred while fetching data.', $e->getMessage());
        }

    }

    public function store(Request $request)
    {
        try {
         $request->validate([
            'nama_lantai' => 'required|string',
            'gedung_otmil_id' => 'required|string',
            'lokasi_otmil_id' => 'required|string',
            'panjang' => 'nullable',
            'lebar' => 'nullable',
            'posisi_X' => 'nullable',
            'posisi_Y' => 'nullable'
         ]);

         $insert = LantaiOtmil::create($request->all());
         return ApiResponse::success([
            'data' => $insert
        ]);
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred while fetching data.', $e->getMessage());
        }
    }

    public function show(Request $request)
    {
        $lantai_otmil_id = $request->input('lantai_otmil_id');
        $dataLantai = LantaiOtmil::where('id', $lantai_otmil_id)->firstOrFail();

        return ApiResponse::success([
            'data' => $dataLantai
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_lantai' => 'required|string',
            'gedung_otmil_id' => 'required|string',
            'lokasi_otmil_id' => 'required|string',
            'panjang' => 'nullable',
            'lebar' => 'nullable',
            'posisi_X' => 'nullable',
            'posisi_Y' => 'nullable'
         ]);
         $lantai_otmil_id = $request->input('lantai_otmil_id');
         $findLantai = LantaiOtmil::where('id', $lantai_otmil_id)->firstOrFail();
         $findLantai->nama_lantai = $request->input('nama_lantai');
         $findLantai->lokasi_otmil_id = $request->input('lokasi_otmil_id');
         $findLantai->gedung_otmil_id = $request->input('gedung_otmil_id');
         $findLantai->panjang = $request->input('panjang');
         $findLantai->lebar = $request->input('lebar');
         $findLantai->posisi_X = $request->input('posisi_X');
         $findLantai->posisi_Y = $request->input('posisi_Y');
 
         $findLantai->save();
         return ApiResponse::updated();
    }

    public function destroy(Request $request)
    {
        $lantai_otmil_id = $request->input('lantai_otmil_id');
        $lantai_otmil = LantaiOtmil::findOrFail($lantai_otmil_id);
        $lantai_otmil->delete();
    
        return ApiResponse::deleted();   
    }
}
