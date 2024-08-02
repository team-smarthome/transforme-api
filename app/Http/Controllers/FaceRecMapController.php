<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\FaceRecMapRequest;
use App\Http\Resources\FaceRecMapResource;
use App\Models\FaceRec;
use Exception;
use Illuminate\Http\Request;

class FaceRecMapController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = FaceRec::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);
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

            $filters = $request->input('filter', []);

            foreach ($filterableColumns as $requestKey => $column) {
                if (isset($filters[$requestKey])) {
                    if ($requestKey === 'nama_ruangan_otmil') {
                        $query->whereHas('ruanganOtmil', function ($q) use ($filters, $requestKey) {
                            $q->where('nama_ruangan_otmil', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } elseif ($requestKey === 'nama_ruangan_lemasmil') {
                        $query->whereHas('ruanganLemasmil', function ($q) use ($filters, $requestKey) {
                            $q->where('nama_ruangan_lemasmil', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } elseif ($requestKey === 'jenis_ruangan_otmil') {
                        $query->whereHas('ruanganOtmil', function ($q) use ($filters, $requestKey) {
                            $q->where('jenis_ruangan_otmil', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } elseif ($requestKey === 'jenis_ruangan_lemasmil') {
                        $query->whereHas('ruanganLemasmil', function ($q) use ($filters, $requestKey) {
                            $q->where('jenis_ruangan_lemasmil', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } elseif ($requestKey === 'lokasi_otmil_id') {
                        $query->whereHas('ruanganOtmil.lokasiOtmil', function ($q) use ($filters, $requestKey) {
                            $q->where('lokasi_otmil_id', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } elseif ($requestKey === 'lokasi_lemasmil_id') {
                        $query->whereHas('ruanganLemasmil.lokasiLemasmil', function ($q) use ($filters, $requestKey) {
                            $q->where('lokasi_lemasmil_id', 'LIKE', '%' . $filters[$requestKey] . '%');
                        });
                    } else {
                        $query->where($column, 'LIKE', '%' . $filters[$requestKey] . '%');
                    }
                }
            }

            $query->latest();
            $faceRecData = $query->get();

            $totalFaceRec = $faceRecData->count();
            $totalaktif = $faceRecData->where('status_face_rec', 'aktif')->count();
            $totalnonaktif = $faceRecData->where('status_face_rec', 'nonaktif')->count();

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = FaceRecMapResource::collection($paginatedData);

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

    public function store(FaceRecMapRequest $request)
    {
        try {
            if (FaceRec::where('gmac', $request->gmac)->exists()) {
                return ApiResponse::error('Failed to create Face Rec.', 'Gmac already exists.');
            }

            $FaceRec = new FaceRec([
                'gmac' => $request->gmac,
                'nama_face_rec' => $request->nama_face_rec,
                'ruangan_otmil_id' => $request->ruangan_otmil_id,
                'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
                'status_face_rec' => $request->status_face_rec,
                'v_face_rec_topic' => $request->v_face_rec_topic
            ]);

            if ($FaceRec->save()) {
                $data = $FaceRec->toArray();
                $formattedData = array_merge(['id' => $FaceRec->id], $data);
                return ApiResponse::created($formattedData);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create Face Rec.', $e->getMessage());
        }
    }

    public function update(FaceRecMapRequest $request)
    {
        try {
            $id = $request->input('face_rec_id');
            $faceRec = FaceRec::findOrFail($id);
            $faceRec->gmac = $request->gmac;
            $faceRec->nama_face_rec = $request->nama_face_rec;
            $faceRec->ruangan_otmil_id = $request->ruangan_otmil_id;
            $faceRec->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $faceRec->status_face_rec = $request->status_face_rec;
            $faceRec->v_face_rec_topic = $request->v_face_rec_topic;

            if ($faceRec->save()) {
                $data = $faceRec->toArray();
                return ApiResponse::updated($data);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update Face Rec.', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->input('face_rec_id');
            $faceRec = FaceRec::findOrFail($id);
            if (!$faceRec) {
                return ApiResponse::error('Face Rec not found.', 'Face Rec not found.', 404);
            }
            $faceRec->delete();
            return ApiResponse::deleted();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete Face Rec.', $e->getMessage());
        }
    }
}
