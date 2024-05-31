<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sidang;
use App\Http\Requests\SidangRequest;
use App\Helpers\ApiResponse;
use Exception;


class SidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // $sidang = Sidang::with('oditurPenuntut')->get();
            // return [
            //     'status' => 'OK',
            //     'message' => 'Data sidang berhasil diambil',
            //     'data' => $sidang
            // ];
            $query = Sidang::with('oditurPenuntut');
            $filterableColumns = [
                'sidang_id' => 'id',
                'nama_sidang' => 'nama_sidang',
                'kasus_id' => 'kasus_id',                
            ];
            foreach ($filterableColumns as $requestKey => $column) {
                if ($value = request($requestKey)) {
                    $query->where($column, 'like', '%' . $value . '%');
                }
            }

            $query->latest();
            return ApiResponse::paginate($query);
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
    public function store(SidangRequest $request)
    {
        \DB::beginTransaction();
        try {
            $sidang = Sidang::create($request->all());
            $pivotData = [];
            if ($request->has('oditur_penuntut_id')) {
                foreach ($request->oditur_penuntut_id as $index => $oditurId) {
                    $pivotData[] = [
                        'id' => \Illuminate\Support\Str::uuid(),
                        'sidang_id' => $sidang->id,
                        'oditur_penuntut_id' => $oditurId,
                        'role_ketua' => $request->role_ketua[$index],
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }
            \DB::table('pivot_sidang_oditur')->insert($pivotData);
            \DB::commit();
            //buat response gabungin $sidang dan $pivotData
            $sidang->oditurPenuntut = $pivotData;
            return ApiResponse::created($sidang);
        } catch (\Exception $e) {
            \DB::rollBack();
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
        \DB::beginTransaction();
        try {
            $id = $request->input('sidang_id');
            $sidang = Sidang::findOrFail($id);
            $sidang->update($request->all());

            //get pivot data craeted_at for update pivot data
            $createdAtPivot = \DB::table('pivot_sidang_oditur')->where('sidang_id', $sidang->id)->pluck('created_at')->toArray();
    
            // Update pivot data if oditur_penuntut_id is present in request
            if ($request->has('oditur_penuntut_id')) {
                $pivotData = [];
                foreach ($request->oditur_penuntut_id as $index => $oditurId) {
                    $pivotData[] = [
                        'id' => \Illuminate\Support\Str::uuid(),
                        'sidang_id' => $sidang->id,
                        'oditur_penuntut_id' => $oditurId,
                        'role_ketua' => $request->role_ketua[$index],
                        'created_at' => $createdAtPivot[$index],
                        'updated_at' => now()
                    ];
                }
                \DB::table('pivot_sidang_oditur')->where('sidang_id', $sidang->id)->delete();
                \DB::table('pivot_sidang_oditur')->insert($pivotData);
            }
    
            \DB::commit();
            // Response with updated data
            return ApiResponse::created($sidang);
        } catch (\Exception $e) {
            \DB::rollBack();
            return ApiResponse::error($e->getMessage(), 'Data sidang gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        \DB::beginTransaction();
        try {
            $id = $request->input('sidang_id');
            $sidang = Sidang::findOrFail($id);
            $sidang->delete();
    
            \DB::table('pivot_sidang_oditur')
            ->where('sidang_id', $sidang->id)
            ->update(['deleted_at' => now()]);
            \DB::commit();
            return ApiResponse::deleted();
        } catch (\Exception $e) {
            \DB::rollBack();
            return ApiResponse::error($e->getMessage(), 'Data sidang gagal dihapus');
        }
    }
}
