<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\NvrRequest;
use App\Http\Resources\NvrResource;
use App\Models\NvrModel;
use Exception;
use Illuminate\Http\Request;

class NvrController extends Controller
{
  public function index(Request $request)
    {
           try {
            $query = NvrModel::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);
            $filterableColumns = [
                'lokasi_otmil_id' => 'ruanganOtmil.lokasiOtmil.lokasi_otmil_id',
                'lokasi_lemasmil_id' => 'ruanganLemasmil.lokasiLemasmil.lokasi_lemasmil_id',
                'ruangan_otmil_id' => 'ruangan_otmil_id',
                'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
                'gmac' => 'gmac',
                'nama_nvr' => 'nama_nvr',
                'model' => 'model',
                'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
                'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan_lemasmil',
                'jenis_ruangan_otmil' => 'ruanganOtmil.jenis_ruangan_otmil',
                'jenis_ruangan_lemasmil' => 'ruanganLemasmil.jenis_ruangan_lemasmil',
                'status_nvr' => 'status_nvr'
            ];

            if ($request->has('nama_nvr')) {
                $nama_nvr = $request->input('nama_nvr');
                if (is_array($nama_nvr)) {
                    $query->whereIn('nama_nvr', $nama_nvr);
                } else {
                    $query->where('nama_nvr', 'like', '%' . $nama_nvr . '%');
                }
            }

            $query->latest();
            $nvrData = $query->get();

            $totalnvr = $nvrData->count();
            $totalaktif = $nvrData->where('status_nvr', 'aktif')->count();
            $totalnonaktif = $nvrData->where('status_nvr', 'nonaktif')->count();

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = NvrResource::collection($paginatedData);

            $responseData = [
                "status" => "OK",
                "message" => "Successfully get Data",
                "records" => $resourceCollection->toArray($request),
                "totalnvr$totalnvr" => $totalnvr,
                "totalaktif" => $totalaktif,
                "totalnonaktif" => $totalnonaktif,
                "pagination" => [
                    "currentPage" => $paginatedData->currentPage(),
                    "pageSize" => $paginatedData->perPage(),
                    "from" => $paginatedData->firstItem(),
                    "to" => $paginatedData->lastItem(),
                    "totalRecords" => $paginatedData->total(),
                    "totalPages" => $paginatedData->lastPage()
                ]
            ];

            return response()->json($responseData);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to get Data.', $e->getMessage());
        }
    }

    public function store(NvrRequest $request)
    {
        try {
            if (NvrModel::where('gmac', $request->gmac)->exists()) {
                return ApiResponse::error('Failed to create nvr.', 'Gmac already exists.');
            }

            $nvr = new NvrModel([
                'gmac' => $request->gmac,
                'nama_nvr' => $request->nama_nvr,
                'ruangan_otmil_id' => $request->ruangan_otmil_id,
                'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
                'status_nvr' => $request->status_nvr,
                'v_nvr_topic' => $request->v_nvr_topic
            ]);

            $nvr->save();

            return ApiResponse::created($nvr);
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create nvr.', $e->getMessage());
        }
    }

    public function update(NvrRequest $request)
    {
        try {
            $id = $request->input('nvr_id');
            $nvr = NvrModel::findOrFail($id);
            $nvr->gmac = $request->gmac;
            $nvr->nama_nvr = $request->nama_nvr;
            $nvr->ruangan_otmil_id = $request->ruangan_otmil_id;
            $nvr->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $nvr->status_nvr = $request->status_nvr;
            $nvr->v_nvr_topic = $request->v_nvr_topic;

            $nvr->save();

            return ApiResponse::updated($nvr);
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update Face Rec.', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->input('nvr_id');
            $FaceRec = NvrModel::findOrFail($id);
            if (!$FaceRec) {
                return ApiResponse::error('nvr not found.', 'nvr not found.', 404);
            }
            $FaceRec->delete();
            return ApiResponse::deleted();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete nvr.', $e->getMessage());
        }
    }
}
