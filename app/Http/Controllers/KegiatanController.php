<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\KegiatanRequest;
use App\Helpers\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Kegiatan::with(['ruanganOtmil', 'ruanganLemasmil', 'wbpProfile']);
        $filterableColumns = [
            'kegiatan_id' => 'id',
            'nama_kegiatan' => 'nama_kegiatan',
            'ruangan_otmil_id' => 'ruangan_otmil_id',
            'ruangan_lemasmil_id' => 'ruangan_lemasmil_id',
            'status_kegiatan' => 'status_kegiatan',
            'waktu_mulai_kegiatan' => 'waktu_mulai_kegiatan',
            'waktu_selesai_kegiatan' => 'waktu_selesai_kegiatan',
            'zona_waktu' => 'zona_waktu',
        ];

        foreach ($filterableColumns as $requestKey => $column) {
            if ($value = request($requestKey)) {
                $query->where($column, 'like', '%' . $value . '%');
            }
        }

        $query->latest();
        return ApiResponse::paginate($query);
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
    public function store(KegiatanRequest $request)
    {
        DB::beginTransaction();
        try {
            $kegiatan = Kegiatan::create($request->validated());
            $kegiatanWbp = [];
            if ($request->has('peserta')) {
                foreach ($request->peserta as $wbpProfileId) {
                    $kegiatanWbp[] = [
                        'id' => \Illuminate\Support\Str::uuid(),
                        'kegiatan_id' => $kegiatan->id,
                        'wbp_profile_id' => $wbpProfileId,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                DB::table('kegiatan_wbp')->insert($kegiatanWbp);
            }
            DB::commit();
            $kegiatan->wbpProfile = $kegiatanWbp;
            return ApiResponse::created($kegiatan);
            
        } catch (Exception $e) {
            DB::rollBack();
            return [
                'status' => 'ERROR',
                'message' => 'Data kegiatan gagal disimpan',
                'data' => $e->getMessage()
            ];
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
    public function update(KegiatanRequest $request)
    {
        DB::beginTransaction();
        try {
            $id = $request->input('kegiatan_id');
            $kegiatan = Kegiatan::findOrFail($id);
            $kegiatan->update($request->validated());

            $craetedKegiatanWbp = DB::table('kegiatan_wbp')->where('kegiatan_id', $id)
                ->pluck('created_at', 'wbp_profile_id')
                ->toArray();
            if ($request -> has('peserta')) {
                $pivotData = [];
                foreach ($request->peserta as $wbpProfileId) {
                    $pivotData[] = [
                        'id' =>  \Illuminate\Support\Str::uuid(),
                        'kegiatan_id' => $kegiatan->id,
                        'wbp_profile_id' => $wbpProfileId,
                        'created_at' => $craetedKegiatanWbp[$wbpProfileId] ?? now(),
                        'updated_at' => now()
                    ];
                }
                DB::table('kegiatan_wbp')->where('kegiatan_id', $id)->delete();
                DB::table('kegiatan_wbp')->insert($pivotData);
            }
            DB::commit();
            return ApiResponse::created($kegiatan);
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::error($e->getMessage(), 'Data kegiatan gagal disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = $request->input('kegiatan_id');
            $kegiatan = Kegiatan::findOrFail($id);
            $kegiatan->delete();
            DB::table('kegiatan_wbp')->where('kegiatan_id', $id)->update(['deleted_at' => now()]);
            DB::commit();
            return ApiResponse::deleted();
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::error($e->getMessage(), 'Data kegiatan gagal dihapus');
        }
    }
}
