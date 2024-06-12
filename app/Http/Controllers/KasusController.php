<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Kasus;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\KasusRequest;
use App\Http\Resources\KasusResource;
use Exception;

class KasusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Kasus::with(['wbpProfilePivot', 'saksiPivot', 'oditurPenyidik', 'jenisPerkara.kategoriPerkara.jenisPidana']);
            
            $filterableColumns = [
                'kasus_id' => 'id',
                'nama_kasus' => 'nama_kasus',
                'nomor_kasus' => 'nomor_kasus',
                'wbp_profile_id' => 'wbp_profile_id',
                'kategori_perkara_id' => 'kategori_perkara_id',
                'jenis_perkara_id' => 'jenis_perkara_id',
                'lokasi_kasus' => 'lokasi_kasus',
                'waktu_kejadian' => 'waktu_kejadian',
                'tanggal_pelimpahan_kasus' => 'tanggal_pelimpahan_kasus',
                'waktu_pelaporan_kasus' => 'waktu_pelaporan_kasus',
                'zona_waktu' => 'zona_waktu',
                'tanggal_mulai_penyidikan' => 'tanggal_mulai_penyidikan',
                'tanggal_mulai_sidang' => 'tanggal_mulai_sidang',
            ];
    
            foreach ($filterableColumns as $requestKey => $column) {
                if ($request->has($requestKey)) {
                    $query->where($column, 'like', '%' . $request->input($requestKey) . '%');
                }
            }

            if ($request->has('nama_jenis_pidana')) {
                $query->whereHas('jenisPerkara.kategoriPerkara.jenisPidana', function ($q) use ($request) {
                    $q->where('nama_jenis_pidana', 'like', '%' . $request->input('nama_jenis_pidana') . '%');
                });
            }
    
            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
            $resourceCollection = KasusResource::collection($paginatedData);
    
            return ApiResponse::pagination($resourceCollection);
        } catch (\Exception $e) {
            // Handle exception
            return ApiResponse::error($e->getMessage());
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

     public function store(KasusRequest $request)
     {
         DB::beginTransaction();
         try {
             $kasusData = $request->except(['oditur_penyidikan_id', 'role_ketua', 'saksi_id', 'keterangan_saksi', 'wbp_profile_id', 'keterangan_wbp']);
             $kasus = Kasus::create($kasusData);
             
             $pivotoditurData = [];
             if ($request->has('oditur_penyidikan_id')) {
                 foreach ($request->oditur_penyidikan_id as $index => $oditurId) {
                     $pivotoditurData[] = [
                         'id' => \Illuminate\Support\Str::uuid(),
                         'kasus_id' => $kasus->id,
                         'oditur_penyidikan_id' => $oditurId,
                         'role_ketua' => $request->role_ketua[$index],
                         'created_at' => now(),
                         'updated_at' => now()
                     ];
                 }
                 DB::table('pivot_kasus_oditur')->insert($pivotoditurData);
             }
     
             $pivotSaksiData = [];
             if ($request->has('saksi_id')) {
                 foreach ($request->saksi_id as $index => $saksiId) {
                     $pivotSaksiData[] = [
                         'id' => \Illuminate\Support\Str::uuid(),
                         'kasus_id' => $kasus->id,
                         'saksi_id' => $saksiId,
                         'keterangan' => $request->keterangan_saksi[$index],
                         'created_at' => now(),
                         'updated_at' => now()
                     ];
                 }
                 DB::table('pivot_kasus_saksi')->insert($pivotSaksiData);
             }
     
             $pivotWbpData = [];
             if ($request->has('wbp_profile_id') && is_array($request->wbp_profile_id)) {
                 foreach ($request->wbp_profile_id as $index => $wbpId) {
                     $pivotWbpData[] = [
                         'id' => \Illuminate\Support\Str::uuid(),
                         'kasus_id' => $kasus->id,
                         'wbp_profile_id' => $wbpId,
                         'keterangan' => $request->keterangan_wbp[$index],
                         'created_at' => now(),
                         'updated_at' => now()
                     ];
                 }
                 DB::table('pivot_kasus_wbp')->insert($pivotWbpData);
             }
     
             DB::commit();
             $kasus->oditurPenyidik = $pivotoditurData;
             $kasus->saksiPivot = $pivotSaksiData;
             $kasus->wbpProfilePivot = $pivotWbpData;
             return ApiResponse::created($kasus);
         } catch (Exception $e) {
             DB::rollBack();
             return ApiResponse::error('Data kasus gagal disimpan.', $e->getMessage());
         }
     }
     

    // public function store(KasusRequest $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $kasus = Kasus::create($request->all());
    //         $pivotoditurData = [];
    //         if ($request->has('oditur_penyidikan_id')) {
    //             foreach ($request->oditur_penyidikan_id as $index => $oditurId) {
    //                 $pivotoditurData[] = [
    //                     'id' => \Illuminate\Support\Str::uuid(),
    //                     'kasus_id' => $kasus->id,
    //                     'oditur_penyidikan_id' => $oditurId,
    //                     'role_ketua' => $request->role_ketua[$index],
    //                     'created_at' => now(),
    //                     'updated_at' => now()
    //                 ];
    //             }
    //             DB::table('pivot_kasus_oditur')->insert($pivotoditurData);
    //         }
    //         $pivotSaksiData = [];
    //         if ($request->has('saksi_id')) {
    //             foreach ($request->saksi_id as $index => $saksiId) {
    //                 $pivotSaksiData[] = [
    //                     'id' => \Illuminate\Support\Str::uuid(),
    //                     'kasus_id' => $kasus->id,
    //                     'saksi_id' => $saksiId,
    //                     'keterangan' => $request->keterangan_saksi[$index],
    //                     'created_at' => now(),
    //                     'updated_at' => now()
    //                 ];
    //             }
    //             DB::table('pivot_kasus_saksi')->insert($pivotSaksiData);
    //         }

    //         $pivotWbpData = [];
    //         if ($request->has('wbp_profile_id') && is_array($request->wbp_profile_id)) {
    //             foreach ($request->wbp_profile_id as $index => $wbpId) {
    //                 $pivotWbpData[] = [
    //                     'id' => \Illuminate\Support\Str::uuid(),
    //                     'kasus_id' => $kasus->id,
    //                     'wbp_profile_id' => $wbpId,
    //                     'keterangan' => $request->keterangan_wbp[$index], // pastikan ini sesuai dengan struktur request Anda
    //                     'created_at' => now(),
    //                     'updated_at' => now()
    //                 ];
    //             }
    //             DB::table('pivot_kasus_wbp')->insert($pivotWbpData);
    //         }
    
            
    //         DB::commit();
    //         $kasus->oditurPenyidik = $pivotoditurData;
    //         $kasus->saksiPivot = $pivotSaksiData;
    //         $kasus->wbpProfilePivot = $pivotWbpData;
    //         return ApiResponse::created($kasus);
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         return ApiResponse::error('Data kasus gagal disimpan.', $e->getMessage());
    //     }
    // }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->input('id');
        $kasus = Kasus::findOrFail($id);
        return response()->json($kasus, 200);
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
    public function update(KasusRequest $request)
    {
        DB::beginTransaction();
        try {
            $id = $request->input('kasus_id');
            $kasus = Kasus::findOrFail($id);
            $kasus->update($request->all());
    
            if ($request->has('oditur_penyidikan_id') && is_array($request->oditur_penyidikan_id)) {
                $createdAtPivot = DB::table('pivot_kasus_oditur')
                    ->where('kasus_id', $kasus->id)
                    ->pluck('created_at', 'oditur_penyidikan_id')
                    ->toArray();
                $this->updatePivotData($kasus, 'pivot_kasus_oditur', 'oditur_penyidikan_id', 'role_ketua', $request->oditur_penyidikan_id, $request->role_ketua, $createdAtPivot);
            }
    
            if ($request->has('saksi_id') && is_array($request->saksi_id)) {
                $createdAtPivot = DB::table('pivot_kasus_saksi')
                    ->where('kasus_id', $kasus->id)
                    ->pluck('created_at', 'saksi_id')
                    ->toArray();
                $this->updatePivotData($kasus, 'pivot_kasus_saksi', 'saksi_id', 'keterangan', $request->saksi_id, $request->keterangan_saksi, $createdAtPivot);
            }
    
            if ($request->has('wbp_profile_id') && is_array($request->wbp_profile_id)) {
                $createdAtPivot = DB::table('pivot_kasus_wbp')
                    ->where('kasus_id', $kasus->id)
                    ->pluck('created_at', 'wbp_profile_id')
                    ->toArray();
                $this->updatePivotData($kasus, 'pivot_kasus_wbp', 'wbp_profile_id', 'keterangan', $request->wbp_profile_id, $request->keterangan_wbp, $createdAtPivot);
            }
    
            DB::commit();
            return ApiResponse::updated($kasus);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::error('Data kasus gagal diupdate.', $e->getMessage());
        }
    }
    
    private function updatePivotData($kasus, $pivotTable, $foreignKey, $roleKey, $ids, $roles, $createdAtPivot)
    {
        $pivotData = [];
        foreach ($ids as $index => $id) {
            $data = [
                'id' => \Illuminate\Support\Str::uuid(),
                'kasus_id' => $kasus->id,
                $foreignKey => $id,
                'created_at' => $createdAtPivot[$id] ?? now(), // Gunakan created_at yang ada jika tersedia
                'updated_at' => now()
            ];
            if ($roleKey !== null && isset($roles[$index])) {
                $data[$roleKey] = $roles[$index];
            }
            $pivotData[] = $data;
        }
    
        DB::table($pivotTable)->where('kasus_id', $kasus->id)->delete();
        DB::table($pivotTable)->insert($pivotData);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
      DB::beginTransaction();
      try {
        $id = $request->input('kasus_id');
        $kasus = Kasus::findOrFail($id);
        $kasus->delete();
  
        // Soft delete entries in the pivot tables by updating the deleted_at column
        $this->softDeletePivotData('pivot_kasus_oditur', $kasus->id);
        $this->softDeletePivotData('pivot_kasus_saksi', $kasus->id);
        $this->softDeletePivotData('pivot_kasus_wbp', $kasus->id);
  
        DB::commit();
        return ApiResponse::deleted();
      } catch (\Exception $e) {
        DB::rollBack();
        return ApiResponse::error($e->getMessage(), 'Data kasus gagal dihapus');
      }
    }
  
    // Helper function to soft delete entries in pivot tables
    private function softDeletePivotData($pivotTable, $kasusId)
    {
      DB::table($pivotTable)
        ->where('kasus_id', $kasusId)
        ->update(['deleted_at' => now()]);
    }

    public function restore($id){
        $kasus = Kasus::withTrashed()->findOrFail($id);
        $kasus->restore();

        return response()->json($kasus);
    }
}
