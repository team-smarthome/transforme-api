<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\EmergencyPushButton;
use App\Http\Requests\EmergencyPushRequest;
use App\Http\Resources\EmergencyPushButtonResource;
use Exception;

use Illuminate\Http\Request;

class EmergencyPushButtonController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = EmergencyPushButton::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);

            if ($request->has('nama_emergency_push_button')) {
                $nama_emergency_push_button = $request->input('nama_emergency_push_button');
                if (is_array($nama_emergency_push_button)) {
                    $query->whereIn('nama_emergency_push_button', $nama_emergency_push_button);
                } else {
                    $query->where('nama_emergency_push_button', 'ilike', '%' . $nama_emergency_push_button . '%');
                }
            }


            if ($request->has('status_emergency_push_button')) {
                $status_emergency_push_button = $request->input('status_emergency_push_button');
                if (is_array($status_emergency_push_button)) {
                    $query->whereIn('status_emergency_push_button', $status_emergency_push_button);
                } else {
                    $query->where('status_emergency_push_button', 'ilike', '%' . $status_emergency_push_button . '%');
                }
            }

            if ($request->has('gedung_otmil_id')) {
                $gedung_otmil_id = $request->input('gedung_otmil_id');
                if (is_array($gedung_otmil_id)) {
                    $query->whereHas('ruanganOtmil.lantaiOtmil', function ($q) use ($gedung_otmil_id) {
                        $q->whereIn('gedung_otmil_id', $gedung_otmil_id);
                    });
                } else {
                    $query->whereHas('ruanganOtmil.lantaiOtmil', function ($q) use ($gedung_otmil_id) {
                        $q->where('gedung_otmil_id', $gedung_otmil_id);
                    });
                }
            }

            if ($request->has('lantai_otmil_id')) {
                $lantai_otmil_id = $request->input('lantai_otmil_id');
                if (is_array($lantai_otmil_id)) {
                    $query->whereHas('ruanganOtmil', function ($q) use ($lantai_otmil_id) {
                        $q->whereIn('lantai_otmil_id', $lantai_otmil_id);
                    });
                } else {
                    $query->whereHas('ruanganOtmil', function ($q) use ($lantai_otmil_id) {
                        $q->where('lantai_otmil_id', $lantai_otmil_id);
                    });
                }
            }

            if ($request->has('ruangan_otmil_id')) {
                $ruangan_otmil_id = $request->input('ruangan_otmil_id');
                if (is_array($ruangan_otmil_id)) {
                    $query->whereIn('ruangan_otmil_id', $ruangan_otmil_id);
                } else {
                    $query->where('ruangan_otmil_id', $ruangan_otmil_id);
                }
            }
            $query->latest();
            $emergency_push_buttonData = $query->get();

            $totalemergencypushbutton = $emergency_push_buttonData->count();
            $totalaktif = $emergency_push_buttonData->where('status_emergency_push_button', 'aktif')->count();
            $totalnonaktif = $emergency_push_buttonData->where('status_emergency_push_button', 'nonaktif')->count();

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = EmergencyPushButtonResource::collection($paginatedData);

            $responseData = [
                "status" => "OK",
                "message" => "Successfully get Data",
                "records" => $resourceCollection->toArray($request),
                "totalemergencypushbutton" => $totalemergencypushbutton,
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

    public function store(EmergencyPushRequest $request)
    {
        try {
            // Periksa apakah gmac sudah ada
            if (EmergencyPushButton::where('gmac', $request->gmac)->exists()) {
                return ApiResponse::error('Failed to create Emergency Push Button.', 'Gmac already exists.');
            }

            // Buat objek Gateway baru
            $registrationEmergencyPushButton = new EmergencyPushButton([
                'gmac' => $request->gmac,
                'nama_emergency_push_button' => $request->nama_emergency_push_button,
                'ruangan_otmil_id' => $request->ruangan_otmil_id,
                'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
                'status_emergency_push_button' => $request->status_emergency_push_button,
                'v_emergency_push_button_topic' => $request->v_emergency_push_button_topic,
                'posisi_X' => $request->posisi_X,
                'posisi_Y' => $request->posisi_Y,
            ]);

            // Simpan gateway
            if ($registrationEmergencyPushButton->save()) {
                $data = $registrationEmergencyPushButton->toArray();
                $formattedData = array_merge(['id' => $registrationEmergencyPushButton->id], $data);
                return ApiResponse::created($formattedData);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create Emergency Push Button.', $e->getMessage());
        }
    }

    public function update(EmergencyPushRequest $request)
    {
        try {
            $id = $request->input('emergency_push_button_id');
            $emergencyPushButton = EmergencyPushButton::findOrFail($id);
            $emergencyPushButton->gmac = $request->gmac;
            $emergencyPushButton->nama_emergency_push_button = $request->nama_emergency_push_button;
            $emergencyPushButton->ruangan_otmil_id = $request->ruangan_otmil_id;
            $emergencyPushButton->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $emergencyPushButton->status_emergency_push_button = $request->status_emergency_push_button;
            $emergencyPushButton->v_emergency_push_button_topic = $request->v_emergency_push_button_topic;

            if ($emergencyPushButton->save()) {
                $data = $emergencyPushButton->toArray();
                return ApiResponse::updated($data);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update Emergency Push Button.', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->input('emergency_push_button_id');
            $emergencyPushButton = EmergencyPushButton::findOrFail($id);
            if (!$emergencyPushButton) {
                return ApiResponse::error('Emergency Push Button not found.', 'Emergency Push Button not found.', 404);
            }
            $emergencyPushButton->delete();
            return ApiResponse::deleted();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete Emergency Push Button.', $e->getMessage());
        }
    }
}
