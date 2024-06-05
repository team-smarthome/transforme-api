<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\GedungOtmilResource;
use App\Models\GedungOtmil;
use Illuminate\Http\Request;

class GedungOtmilController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = GedungOtmil::query();
            $filterableColumns = ['nama_gedung_otmil'];
            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $column) {
                if (isset($filters[$column])) {
                    $query->where($column, 'like', '%' . $filters[$column] . '%');
                }
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = GedungOtmilResource::collection($paginatedData);
            return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred while fetching data.', $e->getMessage());
        }
    }



    public function store(Request $request)
    {
        $request->validate([
            'nama_gedung_otmil' => 'required|string|max:100',
            'lokasi_otmil_id' => 'required|string|max:100',
            'panjang' => 'nullable',
            'lebar' => 'nullable',
            'posisi_X' => 'nullable',
            'posisi_Y' => 'nullable'
        ]);

        $dataGedung = GedungOtmil::create($request->all());

        return ApiResponse::success([
            'data' => new GedungOtmilResource($dataGedung)
        ]);
    }

    public function show(Request $request)
    {
        $request->validate([
            'gedung_otmil_id' => 'required|string|max:100',
        ]);

        $gedung_otmil_id = $request->input('gedung_otmil_id');
        $dataGedung = GedungOtmil::where('id', $gedung_otmil_id)->firstOrFail();

        return ApiResponse::success(
            new GedungOtmilResource($dataGedung)
        );
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_gedung_otmil' => 'required|string|max:100',
            'lokasi_otmil_id' => 'required|string|max:100',
            'panjang' => 'nullable',
            'lebar' => 'nullable',
            'posisi_X' => 'nullable',
            'posisi_Y' => 'nullable'
        ]);

        $gedung_otmil_id = $request->input('gedung_otmil_id');
        $dataGedung = GedungOtmil::where('id', $gedung_otmil_id)->firstOrFail();
        $dataGedung->nama_gedung_otmil = $request->input('nama_gedung_otmil');
        $dataGedung->lokasi_otmil_id = $request->input('lokasi_otmil_id');
        $dataGedung->panjang = $request->input('panjang');
        $dataGedung->lebar = $request->input('lebar');
        $dataGedung->posisi_X = $request->input('posisi_X');
        $dataGedung->posisi_Y = $request->input('posisi_Y');

        $dataGedung->save();

        return ApiResponse::updated(
            new GedungOtmilResource($dataGedung)
        );
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'gedung_otmil_id' => 'required|string',
        ]);

        $gedung_otmil_id = $request->input('gedung_otmil_id');
        $dataGedung = GedungOtmil::where('id', $gedung_otmil_id)->firstOrFail();
        $dataGedung->delete();

        return ApiResponse::deleted(
            new GedungOtmilResource($dataGedung)
        );
    }
}
