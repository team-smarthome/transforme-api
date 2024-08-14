<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\FaceRecRequest;
use App\Http\Resources\FaceRecResource;
use App\Models\FaceRecModel;
use Exception;
use Illuminate\Http\Request;

class FaceRecMapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
           try {
            $query = FaceRecModel::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);
            $filterableColumns = [
                'lokasi_otmil_id' => 'ruanganOtmil.lokasiOtmil.lokasi_otmil_id',
                'lokasi_lemasmil_id' => 'ruanganLemasmil.lokasiLemasmil.lokasi_lemasmil_id',
                'ruangan_otmil_id' => 'ruangan_otmil_id',
                'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
                'gmac' => 'gmac',
                'nama_face_rec' => 'nama_face_rec',
                'model' => 'model',
                'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
                'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan_lemasmil',
                'jenis_ruangan_otmil' => 'ruanganOtmil.jenis_ruangan_otmil',
                'jenis_ruangan_lemasmil' => 'ruanganLemasmil.jenis_ruangan_lemasmil',
                'status_face_rec' => 'status_face_rec'
            ];

            if ($request->has('nama_face_rec')) {
                $nama_face_rec = $request->input('nama_face_rec');
                if (is_array($nama_face_rec)) {
                    $query->whereIn('nama_face_rec', $nama_face_rec);
                } else {
                    $query->where('nama_face_rec', 'like', '%' . $nama_face_rec . '%');
                }
            }

            $query->latest();
            $facerecData = $query->get();

            $totalFaceRec = $facerecData->count();
            $totalaktif = $facerecData->where('status_face_rec', 'aktif')->count();
            $totalnonaktif = $facerecData->where('status_face_rec', 'nonaktif')->count();

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = FaceRecResource::collection($paginatedData);

            $responseData = [
                "status" => "OK",
                "message" => "Successfully get Data",
                "records" => $resourceCollection->toArray($request),
                "totalFaceRec" => $totalFaceRec,
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
    public function store(FaceRecRequest $request)
    {
        try {
            if (FaceRecModel::where('gmac', $request->gmac)->exists()) {
                return ApiResponse::error('Failed to create Face Rec.', 'Gmac already exists.');
            }

            $FaceRec = new FaceRecModel([
                'gmac' => $request->gmac,
                'nama_face_rec' => $request->nama_face_rec,
                'ruangan_otmil_id' => $request->ruangan_otmil_id,
                'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
                'status_face_rec' => $request->status_face_rec,
                'v_face_rec_topic' => $request->v_face_rec_topic
            ]);

            $FaceRec->save();

            return ApiResponse::created($FaceRec);
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create Face Rec.', $e->getMessage());
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
    public function update(FaceRecRequest $request)
    {
        try {
            $id = $request->input('face_rec_id');
            $FaceRec = FaceRecModel::findOrFail($id);
            $FaceRec->gmac = $request->gmac;
            $FaceRec->nama_face_rec = $request->nama_face_rec;
            $FaceRec->ruangan_otmil_id = $request->ruangan_otmil_id;
            $FaceRec->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $FaceRec->status_face_rec = $request->status_face_rec;
            $FaceRec->v_face_rec_topic = $request->v_face_rec_topic;

            $FaceRec->save();

            return ApiResponse::updated($FaceRec);
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update Face Rec.', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('face_rec_id');
            $FaceRec = FaceRecModel::findOrFail($id);
            if (!$FaceRec) {
                return ApiResponse::error('Face Rec not found.', 'Face Rec not found.', 404);
            }
            $FaceRec->delete();
            return ApiResponse::deleted();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete Face Rec.', $e->getMessage());
        }
    }
}
