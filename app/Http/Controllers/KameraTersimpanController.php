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
    public function index(Request $request)
    {
    try {
        $user = $request->get('user');
        
        // return $user->id;
        // exit();
        $query = GrupKameraTersimpan::with(['KameraTersimpan.kamera'])->where('user_id', $user->id)->get();        
        return ApiResponse::success($query);

    } catch (\Exception $e) {
        return ApiResponse::error('Failed to get data.', $e->getMessage());
    }
    }

    public function store(Request $request)
    {
        $uuid = Uuid::uuid4()->toString();
        $user = $request->get('user');
        $namaGrup = $request['nama_grup'];
        $kameras = $request['kamera'];
        try {
            DB::beginTransaction();
            $grupTersimpanData = GrupKameraTersimpan::create([
                'id' => $uuid,
                'nama_grup' => $namaGrup,
                'user_id' => $user->id
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
        $user = $request->get('user');
        $grupId = $request['grup_id'];
        $namaGrup = $request['nama_grup'];
        $kameras = $request['kamera'];
        try {
            DB::beginTransaction();
            $updateGrupKamera = GrupKameraTersimpan::where('id', $grupId)->where('user_id', $user->id)
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
            $user = $request->get('user');
            $grupId = $request['grup_id'];
            $grupData = GrupKameraTersimpan::where('id', $grupId)->where("user_id", $user->id);
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
