<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sidang;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SidangRequest;
use App\Helpers\ApiResponse;
use Exception;
use App\Http\Resources\SidangResource;
use App\Models\DokumenPersidangan;
use App\Models\HistoriVonis;

class SidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Sidang::with(['oditurPenuntut', 'hakim', 'ahli', 'saksi', 'kasus', 'pengadilanMiliter', 'jenisPersidangan', 'wbpProfile', 'historiVonis']);

            $filterableColumns = [
                'nama_sidang' => 'nama_sidang',
                'nama_jenis_persidangan' => 'jenisPersidangan.nama_jenis_persidangan',
                'nama_wbp' => 'wbpProfile.nama',
                'nomor_kasus' => 'kasus.nomor_kasus',
                'nama_kasus' => 'kasus.nama_kasus'
            ];

            foreach ($filterableColumns as $requestKey => $column) {
                if ($request->has($requestKey)) {
                    $query->where($column, 'like', '%' . $request->input($requestKey) . '%');
                }
            }
            // $filters = $request->input('filter', []);

            // foreach ($filterableColumns as $requestKey => $column) {
            //     if (isset($filters[$requestKey])) {
            //         if ($requestKey === 'nama_jenis_persidangan') {
            //             $query->whereHas('jenisPersidangan', function ($q) use ($filters, $requestKey) {
            //                 $q->where('nama_jenis_persidangan', 'LIKE', '%' . $filters[$requestKey] . '%');
            //             });
            //         } else if ($requestKey === 'nama_wbp') {
            //             $query->where('wbpProfile', function ($q) use ($filters, $requestKey) {
            //                 $q->where('nama', 'LIKE', '%' . $filters[$requestKey] . '%');
            //             });
            //         } else if ($requestKey === 'nomor_kasus') {
            //             $query->where('kasus', function ($q) use ($filters, $requestKey) {
            //                 $q->where('nomor_kasus', 'LIKE', '%' . $filters[$requestKey] . '%');
            //             });
            //         } else if ($requestKey === 'nama_kasus') {
            //             $query->where('kasus', function ($q) use ($filters, $requestKey) {
            //                 $q->where('nama_kasus', 'LIKE', '%' . $filters[$requestKey] . '%');
            //             });
            //         } else {
            //             $query->where($column, 'like', '%' . $filters[$requestKey] . '%');
            //         }
            //     }
            // }

            $query->latest();
            $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));

            $resouceCollections = SidangResource::collection($paginatedData);
            return ApiResponse::pagination($resouceCollections, 'Successfully get Data');
        } catch (\Exception $e) {
            return [
                'status' => 'ERROR',
                'message' => 'Data sidang gagal diambil',
                'data' => $e->getMessage()
            ];
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
    // public function store(SidangRequest $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $sidang = Sidang::create($request->all());
    //         $pivotOditurData = [];
    //         if ($request->has('oditur_penuntut_id')) {
    //             foreach ($request->oditur_penuntut_id as $index => $oditurId) {
    //                 $pivotOditurData[] = [
    //                     'id' => \Illuminate\Support\Str::uuid(),
    //                     'sidang_id' => $sidang->id,
    //                     'oditur_penuntut_id' => $oditurId,
    //                     'role_ketua' => $request->role_ketua[$index],
    //                     'created_at' => now(),
    //                     'updated_at' => now()
    //                 ];
    //             }
    //             DB::table('pivot_sidang_oditur')->insert($pivotOditurData);
    //         }

    //         $pivotHakimData = [];
    //         if ($request->has('hakim_id')) {
    //             foreach ($request->hakim_id as $index => $hakimId) {
    //                 $pivotHakimData[] = [
    //                     'id' => \Illuminate\Support\Str::uuid(),
    //                     'sidang_id' => $sidang->id,
    //                     'hakim_id' => $hakimId,
    //                     'role_ketua' => $request->role_ketua[$index] ?? null,
    //                     'created_at' => now(),
    //                     'updated_at' => now()
    //                 ];
    //             }
    //             DB::table('pivot_sidang_hakim')->insert($pivotHakimData);
    //         }
    //         $pivotAhliData = [];
    //         if ($request->has('ahli_id')) {
    //             foreach ($request->ahli_id as $index => $ahliId)
    //                 $pivotAhliData[] = [
    //                     'id' => \Illuminate\Support\Str::uuid(),
    //                     'sidang_id' => $sidang->id,
    //                     'ahli_id' => $ahliId,
    //                     'created_at' => now(),
    //                     'updated_at' => now()
    //                 ];

    //             DB::table('pivot_sidang_ahli')->insert($pivotAhliData);
    //         }
    //         $pivotSaksiData = [];
    //         if ($request->has('saksi_id')) {
    //             foreach ($request->saksi_id as $index => $saksiId)
    //                 $pivotSaksiData[] = [
    //                     'id' => \Illuminate\Support\Str::uuid(),
    //                     'sidang_id' => $sidang->id,
    //                     'saksi_id' => $saksiId,
    //                     'created_at' => now(),
    //                     'updated_at' => now()
    //                 ];

    //             DB::table('pivot_sidang_saksi')->insert($pivotSaksiData);
    //         }

    //         if ($request->hasFile('link_dokumen_persidangan')) {
    //             $dokumenPersidangan = [];
    //             foreach ($request->file('link_dokumen_persidangan') as $index => $file) {
    //                 $dokumenPath = $file->store('public/dokumen_persidangan');
    //                 $dokumenPersidangan[] = [
    //                     'id' => \Illuminate\Support\Str::uuid(),
    //                     'nama_dokumen_persidangan' => $request->nama_dokumen_persidangan[$index] ?? 'Unknown Document',
    //                     'link_dokumen_persidangan' => str_replace('public/', '', $dokumenPath),
    //                     'sidang_id' => $sidang->id,
    //                     'created_at' => now(),
    //                     'updated_at' => now()
    //                 ];
    //             }
    //             DB::table('dokumen_persidangan')->insert($dokumenPersidangan);
    //         }


    //         DB::commit();
    //         //buat response gabungin $sidang dan $pivotData
    //         $sidang->oditurPenuntut = $pivotOditurData;
    //         $sidang->hakim = $pivotHakimData;
    //         $sidang->ahli = $pivotAhliData;
    //         $sidang->saksi = $pivotSaksiData;
    //         //   $sidang->dokumenPersidangan = $dokumenPersidangan;
    //         return ApiResponse::created($sidang);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return [
    //             'status' => 'ERROR',
    //             'message' => 'Data sidang gagal disimpan',
    //             'data' => $e->getMessage()
    //         ];
    //     }
    // }
    public function store(SidangRequest $request)
    {
        DB::beginTransaction();
        try {
            $sidang = Sidang::create($request->all());
            $pivotOditurData = [];
            if ($request->has('oditur_penuntut_id')) {
                foreach ($request->oditur_penuntut_id as $index => $oditurId) {
                    $pivotOditurData[] = [
                        'id' => \Illuminate\Support\Str::uuid(),
                        'sidang_id' => $sidang->id,
                        'oditur_penuntut_id' => $oditurId,
                        'role_ketua' => $request->role_ketua[$index] ?? null,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                DB::table('pivot_sidang_oditur')->insert($pivotOditurData);
            }

            $pivotHakimData = [];
            if ($request->has('hakim_id')) {
                foreach ($request->hakim_id as $index => $hakimId) {
                    $pivotHakimData[] = [
                        'id' => \Illuminate\Support\Str::uuid(),
                        'sidang_id' => $sidang->id,
                        'hakim_id' => $hakimId,
                        'role_ketua' => $request->role_ketua[$index] ?? null,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                DB::table('pivot_sidang_hakim')->insert($pivotHakimData);
            }

            $pivotAhliData = [];
            if ($request->has('ahli_id')) {
                foreach ($request->ahli_id as $index => $ahliId) {
                    $pivotAhliData[] = [
                        'id' => \Illuminate\Support\Str::uuid(),
                        'sidang_id' => $sidang->id,
                        'ahli_id' => $ahliId,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                DB::table('pivot_sidang_ahli')->insert($pivotAhliData);
            }

            $pivotSaksiData = [];
            if ($request->has('saksi_id')) {
                foreach ($request->saksi_id as $index => $saksiId) {
                    $pivotSaksiData[] = [
                        'id' => \Illuminate\Support\Str::uuid(),
                        'sidang_id' => $sidang->id,
                        'saksi_id' => $saksiId,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                DB::table('pivot_sidang_saksi')->insert($pivotSaksiData);
                // $sidang->saksi()->attach($pivotSaksiData);
            }

            // $pivotSaksiData = [];
            // if ($request->has('saksi_id')) {
            //     foreach ($request->saksi_id as $index => $saksiId) {
            //         $pivotSaksiData[] = [
            //             'saksi_id' => $saksiId,
            //             'sidang_id' => $sidang->id,
            //             'created_at' => now(),
            //             'updated_at' => now()
            //         ];
            //     }
            //     $sidang->saksi()->attach($pivotSaksiData);
            // }

            if ($request->hasFile('link_dokumen_persidangan')) {
                $file = $request->file('link_dokumen_persidangan');

                $filePath = $file->store('public/dokumen_persidangan');

                $dokumenPersidangan = new DokumenPersidangan([
                    'id' => \Illuminate\Support\Str::uuid(),
                    'sidang_id' => $sidang->id,
                    'nama_dokumen_persidangan' => $request->nama_dokumen_persidangan,
                    'link_dokumen_persidangan' => str_replace('public/', '', $filePath),
                ]);

                // Simpan instance ke database
                $sidang->dokumenPersidangan()->save($dokumenPersidangan);
            }


            $historiVonis = new HistoriVonis([
                'id' => \Illuminate\Support\Str::uuid(),
                'sidang_id' => $sidang->id,
                'hasil_vonis' => $request->hasil_vonis,
                'masa_tahanan_tahun' => $request->masa_tahanan_tahun,
                'masa_tahanan_bulan' => $request->masa_tahanan_bulan,
                'masa_tahanan_hari' => $request->masa_tahanan_hari,
            ]);
            $sidang->historiVonis()->save($historiVonis);

            DB::commit();
            //buat response gabungin $sidang dan $pivotData
            $sidang->oditurPenuntut = $pivotOditurData;
            $sidang->hakim = $pivotHakimData;
            $sidang->ahli = $pivotAhliData;
            $sidang->saksi = $pivotSaksiData;
            // $sidang->dokumenPersidangan = $dokumenPersidangan;
            return ApiResponse::created($sidang);
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status' => 'ERROR',
                'message' => 'Data sidang gagal disimpan',
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

    public function update(SidangRequest $request)
    {
        DB::beginTransaction();
        try {
            $id = $request->input('sidang_id');
            $sidang = Sidang::findOrFail($id);
            $sidang->update($request->all());

            // Update pivot data if oditur_penuntut_id is present in request
            if ($request->has('oditur_penuntut_id')) {
                $createdAtPivot = DB::table('pivot_sidang_oditur')
                    ->where('sidang_id', $sidang->id)
                    ->pluck('created_at', 'oditur_penuntut_id')
                    ->toArray();
                $this->updatePivotData($sidang, 'pivot_sidang_oditur', 'oditur_penuntut_id', 'role_ketua', $request->oditur_penuntut_id, $request->role_ketua, $createdAtPivot);
            }

            // Update pivot data for hakim
            if ($request->has('hakim_id')) {
                $createdAtPivot = DB::table('pivot_sidang_hakim')
                    ->where('sidang_id', $sidang->id)
                    ->pluck('created_at', 'hakim_id')
                    ->toArray();
                $this->updatePivotData($sidang, 'pivot_sidang_hakim', 'hakim_id', 'role_ketua', $request->hakim_id, $request->role_ketua_hakim, $createdAtPivot);
            }

            // Update pivot data for ahli
            if ($request->has('ahli_id')) {
                $createdAtPivot = DB::table('pivot_sidang_ahli')
                    ->where('sidang_id', $sidang->id)
                    ->pluck('created_at', 'ahli_id')
                    ->toArray();
                $this->updatePivotData($sidang, 'pivot_sidang_ahli', 'ahli_id', null, $request->ahli_id, null, $createdAtPivot);
            }

            // Update pivot data for saksi
            if ($request->has('saksi_id')) {
                $createdAtPivot = DB::table('pivot_sidang_saksi')
                    ->where('sidang_id', $sidang->id)
                    ->pluck('created_at', 'saksi_id')
                    ->toArray();
                $this->updatePivotData($sidang, 'pivot_sidang_saksi', 'saksi_id', null, $request->saksi_id, null, $createdAtPivot);
            }

            DB::commit();
            return ApiResponse::created($sidang);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::error($e->getMessage(), 'Data sidang gagal diperbarui');
        }
    }

    private function updatePivotData($sidang, $pivotTable, $foreignKey, $roleKey, $ids, $roles, $createdAtPivot)
    {
        $pivotData = [];
        foreach ($ids as $index => $id) {
            $data = [
                'id' => \Illuminate\Support\Str::uuid(),
                'sidang_id' => $sidang->id,
                $foreignKey => $id,
                'created_at' => $createdAtPivot[$id] ?? now(), // Gunakan created_at yang ada jika tersedia
                'updated_at' => now()
            ];
            if ($roleKey !== null && isset($roles[$index])) {
                $data[$roleKey] = $roles[$index];
            }
            $pivotData[] = $data;
        }

        DB::table($pivotTable)->where('sidang_id', $sidang->id)->delete();
        DB::table($pivotTable)->insert($pivotData);
    }

    // public function update(SidangRequest $request)
    // {
    //   DB::beginTransaction();
    //   try {
    //     $id = $request->input('sidang_id');
    //     $sidang = Sidang::findOrFail($id);
    //     $sidang->update($request->all());

    //     $createdAtPivot = DB::table('pivot_sidang_oditur')->where('sidang_id', $sidang->id)->pluck('created_at')->toArray();

    //     if ($request->has('oditur_penuntut_id')) {
    //       $pivotData = [];
    //       foreach ($request->oditur_penuntut_id as $index => $oditurId) {
    //         $pivotData[] = [
    //           'id' => \Illuminate\Support\Str::uuid(),
    //           'sidang_id' => $sidang->id,
    //           'oditur_penuntut_id' => $oditurId,
    //           'role_ketua' => $request->role_ketua[$index],
    //           'created_at' => $createdAtPivot[$index],
    //           'updated_at' => now()
    //         ];
    //       }
    //       DB::table('pivot_sidang_oditur')->where('sidang_id', $sidang->id)->delete();
    //       DB::table('pivot_sidang_oditur')->insert($pivotData);
    //     }

    //     DB::commit();
    //     return ApiResponse::created($sidang);
    //   } catch (\Exception $e) {
    //     DB::rollBack();
    //     return ApiResponse::error($e->getMessage(), 'Data sidang gagal diperbarui');
    //   }
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Request $request)
    // {
    //   DB::beginTransaction();
    //   try {
    //     $id = $request->input('sidang_id');
    //     $sidang = Sidang::findOrFail($id);
    //     $sidang->delete();

    //     DB::table('pivot_sidang_oditur')
    //       ->where('sidang_id', $sidang->id)
    //       ->update(['deleted_at' => now()]);
    //     DB::commit();
    //     return ApiResponse::deleted();
    //   } catch (\Exception $e) {
    //     DB::rollBack();
    //     return ApiResponse::error($e->getMessage(), 'Data sidang gagal dihapus');
    //   }
    // }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = $request->input('sidang_id');
            $sidang = Sidang::findOrFail($id);
            $sidang->delete();

            // Soft delete entries in the pivot tables by updating the deleted_at column
            $this->softDeletePivotData('pivot_sidang_oditur', $sidang->id);
            $this->softDeletePivotData('pivot_sidang_hakim', $sidang->id);
            $this->softDeletePivotData('pivot_sidang_ahli', $sidang->id);
            $this->softDeletePivotData('pivot_sidang_saksi', $sidang->id);

            DB::commit();
            return ApiResponse::deleted();
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::error($e->getMessage(), 'Data sidang gagal dihapus');
        }
    }

    // Helper function to soft delete entries in pivot tables
    private function softDeletePivotData($pivotTable, $sidangId)
    {
        DB::table($pivotTable)
            ->where('sidang_id', $sidangId)
            ->update(['deleted_at' => now()]);
    }
}
