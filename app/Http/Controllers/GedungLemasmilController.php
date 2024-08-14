<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\GedungLemasmilResource;
use App\Models\GedungLemasmil;
use Illuminate\Http\Request;

class GedungLemasmilController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = GedungLemasmil::query();
            $filterableColumns = ['nama_gedung_lemasmil'];
            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $column) {
                if (isset($filters[$column])) {
                    $query->where($column, 'like', '%' . $filters[$column] . '%');
                }
            }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resourceCollection = GedungLemasmilResource::collection($paginatedData);
            return ApiResponse::pagination($resourceCollection, 'Successfully get Data');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred while fetching data.', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gedung_lemasmil' => 'required|string|max:100',
            'lokasi_lemasmil_id' => 'required|string|max:100',
            'panjang' => 'nullable',
            'lebar' => 'nullable',
            'posisi_X' => 'nullable',
            'posisi_Y' => 'nullable'
        ]);

        $dataGedung = GedungLemasmil::create($request->all());

        return ApiResponse::success([
            'data' => new GedungLemasmilResource($dataGedung)
        ]);
    }

    public function show(Request $request)
    {
        $request->validate([
            'gedung_lemasmil_id' => 'required|string|max:100',
        ]);

        $gedung_lemasmil_id = $request->input('gedung_lemasmil_id');
        $dataGedung = GedungLemasmil::where('id', $gedung_lemasmil_id)->firstOrFail();

        return ApiResponse::success(
            new GedungLemasmilResource($dataGedung)
        );
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_gedung_lemasmil' => 'required|string|max:100',
            'lokasi_lemasmil_id' => 'required|string|max:100',
            'panjang' => 'nullable',
            'lebar' => 'nullable',
            'posisi_X' => 'nullable',
            'posisi_Y' => 'nullable'
        ]);

        $gedung_lemasmil_id = $request->input('gedung_lemasmil_id');
        $dataGedung = GedungLemasmil::where('id', $gedung_lemasmil_id)->firstOrFail();
        $dataGedung->nama_gedung_lemasmil = $request->input('nama_gedung_lemasmil');
        $dataGedung->lokasi_lemasmil_id = $request->input('lokasi_lemasmil_id');
        $dataGedung->panjang = $request->input('panjang');
        $dataGedung->lebar = $request->input('lebar');
        $dataGedung->posisi_X = $request->input('posisi_X');
        $dataGedung->posisi_Y = $request->input('posisi_Y');

        $dataGedung->save();

        return ApiResponse::updated(
            new GedungLemasmilResource($dataGedung)
        );
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'gedung_lemasmil_id' => 'required|string',
        ]);

        $gedung_lemasmil_id = $request->input('gedung_lemasmil_id');
        $dataGedung = GedungLemasmil::where('id', $gedung_lemasmil_id)->firstOrFail();
        $dataGedung->delete();

        return ApiResponse::deleted(
            new GedungLemasmilResource($dataGedung)
        );
    }
}
