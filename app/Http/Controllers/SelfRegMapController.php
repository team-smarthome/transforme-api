<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\SelfRegRequest;
use App\Http\Resources\SelfRegResource;
use App\Models\SelfRegModel;
use Exception;
use Illuminate\Http\Request;

class SelfRegMapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
           try {
            $query = SelfRegModel::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);
            $filterableColumns = [
                'lokasi_otmil_id' => 'ruanganOtmil.lokasiOtmil.lokasi_otmil_id',
                'lokasi_lemasmil_id' => 'ruanganLemasmil.lokasiLemasmil.lokasi_lemasmil_id',
                'ruangan_otmil_id' => 'ruangan_otmil_id',
                'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
                'gmac' => 'gmac',
                'nama_m_kiosk' => 'nama_m_kiosk',
                'model' => 'model',
                'nama_ruangan_otmil' => 'ruanganOtmil.nama_ruangan_otmil',
                'nama_ruangan_lemasmil' => 'ruanganLemasmil.nama_ruangan_lemasmil',
                'jenis_ruangan_otmil' => 'ruanganOtmil.jenis_ruangan_otmil',
                'jenis_ruangan_lemasmil' => 'ruanganLemasmil.jenis_ruangan_lemasmil',
                'status_m_kiosk' => 'status_m_kiosk'
            ];

            if ($request->has('nama_m_kiosk')) {
                $nama_m_kiosk = $request->input('nama_m_kiosk');
                if (is_array($nama_m_kiosk)) {
                    $query->whereIn('nama_m_kiosk', $nama_m_kiosk);
                } else {
                    $query->where('nama_m_kiosk', 'like', '%' . $nama_m_kiosk . '%');
                }
            }

            $query->latest();
            $mkioskData = $query->get();

            $totalMKiosk = $mkioskData->count();
            $totalaktif = $mkioskData->where('status_m_kiosk', 'aktif')->count();
            $totalnonaktif = $mkioskData->where('status_m_kiosk', 'nonaktif')->count();

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = SelfRegResource::collection($paginatedData);

            $responseData = [
                "status" => "OK",
                "message" => "Successfully get Data",
                "records" => $resourceCollection->toArray($request),
                "totalMKiosk" => $totalMKiosk,
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
    public function store(SelfRegRequest $request)
    {
        try {
            $mkiosk = new SelfRegModel();
            $mkiosk->gmac = $request->gmac;
            $mkiosk->nama_m_kiosk = $request->nama_m_kiosk;
            $mkiosk->ruangan_otmil_id = $request->ruangan_otmil_id;
            $mkiosk->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $mkiosk->status_m_kiosk = $request->status_m_kiosk;
            $mkiosk->v_m_kiosk_topic = $request->v_m_kiosk_topic;
            $mkiosk->save();

            return ApiResponse::created('Successfully created new M Kiosk.', new SelfRegResource($mkiosk));
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create new M Kiosk.', $e->getMessage());
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
    public function update(SelfRegRequest $request)
    {
        try {
            $id = $request->input('m_kiosk_id');
            $mkiosk = SelfRegModel::find($id);
            $mkiosk->gmac = $request->gmac;
            $mkiosk->nama_m_kiosk = $request->nama_m_kiosk;
            $mkiosk->ruangan_otmil_id = $request->ruangan_otmil_id;
            $mkiosk->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $mkiosk->status_m_kiosk = $request->status_m_kiosk;
            $mkiosk->v_m_kiosk_topic = $request->v_m_kiosk_topic;
            $mkiosk->save();

            return ApiResponse::updated();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update M Kiosk.', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('m_kiosk_id');
            $mkiosk = SelfRegModel::findOrFail($id);
            $mkiosk->delete();

            return ApiResponse::deleted();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete M Kiosk.', $e->getMessage());
        }
    }
}
