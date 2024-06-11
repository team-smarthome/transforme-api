<?php

namespace App\Http\Controllers;

use App\Models\cr;
use Ramsey\Uuid\Uuid;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Models\KameraTersimpan;
use Illuminate\Support\Facades\DB;
use App\Models\GrupKameraTersimpan;

class KameraTersimpanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    try {
        $query = GrupKameraTersimpan::with(['KameraTersimpan.kamera'])->get();
        
        return ApiResponse::success($query);

    } catch (\Exception $e) {
        return ApiResponse::error('Failed to get data.', $e->getMessage());
    }
    }

    public function store(Request $request)
    {
        $uuid = Uuid::uuid4()->toString();
        $userId = $request['user_id'];
        $namaGrup = $request['nama_grup'];
        $kameras = $request['kamera'];
        try {
            DB::beginTransaction();
            $grupTersimpanData = GrupKameraTersimpan::create([
                'id' => $uuid,
                'nama_grup' => $namaGrup,
                'user_id' => $userId
            ]);
            foreach ($kameras as $kamera) {
            $kameraTersimpanData = KameraTersimpan::create([
            'kamera_id' => $kamera,
            'grup_id' => $uuid,
            ]); 
            };
            DB::commit();
            return response()->json([
                'status' => 'OK',
                'message' => 'Successfully created data.',
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'Failed',
                'message' => 'Failed to create data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function update(Request $request)
    {
        $userId = $request['user_id'];
        $grupId = $request['grup_id'];
        $namaGrup = $request['nama_grup'];
        $kameras = $request['kamera'];
        try {
            DB::beginTransaction();
            $updateGrupKamera = GrupKameraTersimpan::where('id', $grupId)
            ->update([
                'nama_grup' => $namaGrup
            ]);

            $deleteDataKameraTersimpan = KameraTersimpan::where('grup_id', $grupId)->forceDelete();

            foreach ($kameras as $kamera) {
                $kameraTersimpanData = KameraTersimpan::create([
                'kamera_id' => $kamera,
                'grup_id' => $grupId,
                ]); 
                };
                DB::commit();
                return response()->json([
                    'status' => 'OK',
                    'message' => 'Successfully updated data.',
                ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'Failed',
                'message' => 'Failed to update data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $grupId = $request['grup_id'];
            $grupData = GrupKameraTersimpan::where('id', $grupId);
            $grupData->delete();
            return ApiResponse::deleted('Data deleted successfully'
            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Failed to delete data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
