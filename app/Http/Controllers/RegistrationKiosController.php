<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationKiosRequest;
use App\Http\Resources\RegistrationKiosResource;
use App\Models\RegistrationKios;
use Exception;

use Illuminate\Http\Request;

class RegistrationKiosController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = RegistrationKios::with(['ruanganOtmil', 'ruanganLemasmil', 'ruanganOtmil.lokasiOtmil', 'ruanganLemasmil.lokasiLemasmil']);

            if ($request->has('nama_registration_kios')) {
                $nama_registration_kios = $request->input('nama_registration_kios');
                if (is_array($nama_registration_kios)) {
                    $query->whereIn('nama_registration_kios', $nama_registration_kios);
                } else {
                    $query->where('nama_registration_kios', 'ilike', '%' . $nama_registration_kios . '%');
                }
            }


            if ($request->has('status_registration_kios')) {
                $status_registration_kios = $request->input('status_registration_kios');
                if (is_array($status_registration_kios)) {
                    $query->whereIn('status_registration_kios', $status_registration_kios);
                } else {
                    $query->where('status_registration_kios', 'ilike', '%' . $status_registration_kios . '%');
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
            $registration_kiosData = $query->get();

            $totalegistrationkios = $registration_kiosData->count();
            $totalaktif = $registration_kiosData->where('status_registration_kios', 'aktif')->count();
            $totalnonaktif = $registration_kiosData->where('status_registration_kios', 'nonaktif')->count();

            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = RegistrationKiosResource::collection($paginatedData);

            $responseData = [
                "status" => "OK",
                "message" => "Successfully get Data",
                "records" => $resourceCollection->toArray($request),
                "totalegistrationkios" => $totalegistrationkios,
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

    public function store(RegistrationKiosRequest $request)
    {
        try {
            // Periksa apakah gmac sudah ada
            if (RegistrationKios::where('gmac', $request->gmac)->exists()) {
                return ApiResponse::error('Failed to create Registration Kios.', 'Gmac already exists.');
            }

            // Buat objek Gateway baru
            $registrationKios = new RegistrationKios([
                'gmac' => $request->gmac,
                'nama_registration_kios' => $request->nama_registration_kios,
                'ruangan_otmil_id' => $request->ruangan_otmil_id,
                'ruangan_lemasmil_id' => $request->ruangan_lemasmil_id,
                'status_registration_kios' => $request->status_registration_kios,
                'v_registration_kios_topic' => $request->v_registration_kios_topic,
                'posisi_X' => $request->posisi_X,
                'posisi_Y' => $request->posisi_Y,
            ]);

            // Simpan gateway
            if ($registrationKios->save()) {
                $data = $registrationKios->toArray();
                $formattedData = array_merge(['id' => $registrationKios->id], $data);
                return ApiResponse::created($formattedData);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to create Registration Kios.', $e->getMessage());
        }
    }

    public function update(RegistrationKiosRequest $request)
    {
        try {
            $id = $request->input('registration_kios_id');
            $registrationKios = RegistrationKios::findOrFail($id);
            $registrationKios->gmac = $request->gmac;
            $registrationKios->nama_registration_kios = $request->nama_registration_kios;
            $registrationKios->ruangan_otmil_id = $request->ruangan_otmil_id;
            $registrationKios->ruangan_lemasmil_id = $request->ruangan_lemasmil_id;
            $registrationKios->status_registration_kios = $request->status_registration_kios;
            $registrationKios->v_registration_kios_topic = $request->v_registration_kios_topic;

            if ($registrationKios->save()) {
                $data = $registrationKios->toArray();
                return ApiResponse::updated($data);
            }
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update Registration Kios.', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->input('registration_kios_id');
            $registrationKios = RegistrationKios::findOrFail($id);
            if (!$registrationKios) {
                return ApiResponse::error('Registration Kios not found.', 'Registration Kios not found.', 404);
            }
            $registrationKios->delete();
            return ApiResponse::deleted();
        } catch (Exception $e) {
            return ApiResponse::error('Failed to delete Registration Kios.', $e->getMessage());
        }
    }
}
