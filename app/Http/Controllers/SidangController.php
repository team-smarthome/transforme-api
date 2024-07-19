<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sidang;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SidangRequest;
use App\Helpers\ApiResponse;
use Exception;
use App\Http\Resources\SidangResource;


class SidangController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    try {
      $query = Sidang::with(['oditurPenuntut', 'hakim', 'ahli', 'saksi', 'kasus', 'kasus', 'pengadilanMiliter', 'jenisPersidangan', 'wbpProfile']);

      $filterableColumns = [
        "sidang_id" => "id",
        'nama_sidang' => 'nama_sidang',
        'nama_jenis_persidangan' => 'jenisPersidangan.nama_jenis_persidangan',
        'nama_wbp' => 'wbpProfile.nama',
        'nomor_kasus' => 'kasus.nomor_kasus',
        'nama_kasus' => 'kasus.nama_kasus'
      ];

      foreach ($filterableColumns as $requestKey => $column) {
        if ($request->has($requestKey)) {
          if ($requestKey === 'nama_jenis_persidangan') {
            $query->whereHas('jenisPersidangan', function ($query) use ($request, $requestKey) {
              $query->where('nama_jenis_persidangan', 'ILIKE', '%' . $request->input($requestKey) . '%');
            });
          } else {
            $query->where($column, 'ILIKE', '%' . $request->input($requestKey) . '%');
          }
        }
      }
      $query->latest();
      $paginatedData = $query->paginate($request->input('pageSize', ApiResponse::$defaultPagination));
      $resourceCollection = SidangResource::collection($paginatedData);

      return ApiResponse::pagination($resourceCollection);
    } catch (\Exception $e) {
      return [
        'status' => 'ERROR',
        'message' => 'Data sidang gagal diambil',
        'data' => $e->getMessage()
      ];
    }
  }

  public function store(SidangRequest $request)
  {
    DB::beginTransaction();
    try {
      $sidangData = $request->except([
        'oditur_penuntut_id',
        'role_ketua_oditur',
        'hakim_id',
        'role_ketua_hakim',
        'ahli',
        'saksi',
        'pengacara',
        'jenis_pengacara'
      ]);
      $sidang = Sidang::create($sidangData);

      $pivotSidangOditur = [];
      $pivotHakimData = [];
      $pivotAhliData = [];
      $pivotSaksiData = [];
      $pivotPengacaraData = [];
      $pivotVonisData = [];

      if ($request->has('oditur_penuntut_id')) {
        foreach ($request->oditur_penuntut_id as $index => $oditurId) {
          $roleKetua = $request->role_ketua_oditur; // Ambil nilai role_ketua dari request
          // return $roleKetua;
          // exit;
          // Tentukan nilai role_ketua berdasarkan perbandingan dengan $oditurId
          $isKetua = ($roleKetua === $oditurId) ? 1 : 0;

          $pivotoditurData[] = [
            'id' => \Illuminate\Support\Str::uuid(),
            'sidang_id' => $sidang->id,
            'oditur_penuntut_id' => $oditurId,
            'role_ketua_oditur' => $isKetua,
            'created_at' => now(),
            'updated_at' => now()
          ];
        }
        DB::table('pivot_sidang_oditur')->insert($pivotoditurData);
      }

      if ($request->has('hakim_id')) {
        foreach ($request->hakim_id as $index => $hakimId) {
          $roleKetuaHakim = $request->role_ketua_hakim; // Ambil nilai role_ketua_hakim dari request

          // Tentukan nilai role_ketua_hakim berdasarkan perbandingan dengan $hakimId
          $isKetuaHakim = ($roleKetuaHakim === $hakimId) ? 1 : 0;

          $pivotHakimData[] = [
            'id' => \Illuminate\Support\Str::uuid(),
            'sidang_id' => $sidang->id,
            'hakim_id' => $hakimId,
            'role_ketua' => $isKetuaHakim,
            'created_at' => now(),
            'updated_at' => now()
          ];
        }
        DB::table('pivot_sidang_hakim')->insert($pivotHakimData);
      }

      if ($request->has('ahli')) {
        foreach ($request->ahli as $ahliId) {
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

      if ($request->has('saksi')) {
        foreach ($request->saksi as $saksiId) {
          $pivotSaksiData[] = [
            'id' => \Illuminate\Support\Str::uuid(),
            'sidang_id' => $sidang->id,
            'saksi_id' => $saksiId,
            'created_at' => now(),
            'updated_at' => now()
          ];
        }
        DB::table('pivot_sidang_saksi')->insert($pivotSaksiData);
      }

      //pivot sidangn pengacara mengirim nama_pengacara dan jenis_pengacara
      if ($request->has('pengacara')) {
        foreach ($request->pengacara as $namaPengacara) {
          $pivotPengacaraData[] = [
            'id' => \Illuminate\Support\Str::uuid(),
            'sidang_id' => $sidang->id,
            'nama_pengacara' => $namaPengacara,
            //   'jenis_pengacara' => $request->jenis_pengacara[$index],
            'created_at' => now(),
            'updated_at' => now()
          ];
        }
        DB::table('pivot_sidang_pengacara')->insert($pivotPengacaraData);
      }

      if ($request->has('hasil_vonis')) {
        $pivotVonisData = [
          'id' => \Illuminate\Support\Str::uuid()->toString(), // Mengubah menjadi string UUID
          'sidang_id' => $sidang->id, // Pastikan $sidang sudah didefinisikan sebelumnya
          'hasil_vonis' => $request->hasil_vonis,
          'masa_tahanan_tahun' => $request->masa_tahanan_tahun,
          'masa_tahanan_bulan' => $request->masa_tahanan_bulan,
          'masa_tahanan_hari' => $request->masa_tahanan_hari,
          'created_at' => now(),
          'updated_at' => now()
        ];
        DB::table('histori_vonis')->insert($pivotVonisData);
      }

      //   Dokumen Persidangan
      if ($request->hasFile('link_dokumen_persidangan')) {
        $dokumenPath = $request->file('link_dokumen_persidangan')->store('public/dokumen_persidangan');
        $dokumenPath = str_replace('public/', '', $dokumenPath);

        // Menambahkan entri pivot untuk dokumen persidangan
        $pivotDokumenPersidangan = [
          'id' => \Illuminate\Support\Str::uuid()->toString(),
          'sidang_id' => $sidang->id,
          'nama_dokumen_persidangan' => $request->nama_dokumen_persidangan, // Pastikan ini adalah string
          'link_dokumen_persidangan' => $dokumenPath,
          'created_at' => now(),
          'updated_at' => now()
        ];
        DB::table('dokumen_persidangan')->insert($pivotDokumenPersidangan);
      }

      DB::commit();

      // Inisialisasi objek $kasus sebagai array atau objek baru
      $kasus = new \stdClass();
      $kasus->oditurPenuntut = $pivotoditurData ?? [];
      $kasus->hakim = $pivotHakimData ?? [];
      $kasus->ahli = $pivotAhliData ?? [];
      $kasus->saksi = $pivotSaksiData ?? [];
      $kasus->pengacara = $pivotPengacaraData ?? [];
      $kasus->hasil_vonis = $pivotVonisData ?? [];

      return ApiResponse::created();
    } catch (Exception $e) {
      DB::rollBack();
      return ApiResponse::error($e->getMessage(), 'Data sidang gagal disimpan');
    }
  }

  public function update(SidangRequest $request)
  {
    DB::beginTransaction();
    try {
      $id = $request->input('sidang_id');
      $sidang = Sidang::findOrFail($id);

      // Update data sidang
      $sidangData = $request->except([
        'oditur_penuntut_id',
        'role_ketua_oditur',
        'hakim_id',
        'role_ketua_hakim',
        'ahli_id',
        'saksi_id',
        'nama_pengacara',
        'jenis_pengacara',
        'hasil_vonis',
        'masa_tahanan_tahun',
        'masa_tahanan_bulan',
        'masa_tahanan_hari',
        'link_dokumen_persidangan'
      ]);
      $sidang->update($sidangData);

      // Update pivot tabel untuk oditur_penuntut_id
      if ($request->has('oditur_penuntut_id')) {
        $createdAtPivot = DB::table('pivot_sidang_oditur')
          ->where('sidang_id', $sidang->id)
          ->pluck('created_at', 'oditur_penuntut_id')
          ->toArray();
        $pivotOditurData = [];
        foreach ($request->oditur_penuntut_id as $index => $oditurId) {
          $roleKetua = $request->role_ketua_oditur; // Ambil nilai role_ketua dari request

          // Tentukan nilai role_ketua berdasarkan perbandingan dengan $oditurId
          $isKetua = ($roleKetua === $oditurId) ? 1 : 0;

          $pivotOditurData[] = [
            'id' => \Illuminate\Support\Str::uuid(),
            'sidang_id' => $sidang->id,
            'oditur_penuntut_id' => $oditurId,
            'role_ketua_oditur' => $isKetua,
            'created_at' => $createdAtPivot[$oditurId] ?? now(),
            'updated_at' => now()
          ];
        }
        DB::table('pivot_sidang_oditur')->where('sidang_id', $sidang->id)->delete();
        DB::table('pivot_sidang_oditur')->insert($pivotOditurData);
      }

      // Update pivot tabel untuk hakim_id
      if ($request->has('hakim_id')) {
        $createdAtPivot = DB::table('pivot_sidang_hakim')
          ->where('sidang_id', $sidang->id)
          ->pluck('created_at', 'hakim_id')
          ->toArray();
        $pivotHakimData = [];
        foreach ($request->hakim_id as $index => $hakimId) {
          $roleKetuaHakim = $request->role_ketua_hakim; // Ambil nilai role_ketua_hakim dari request

          // Tentukan nilai role_ketua_hakim berdasarkan perbandingan dengan $hakimId
          $isKetuaHakim = ($roleKetuaHakim === $hakimId) ? 1 : 0;

          $pivotHakimData[] = [
            'id' => \Illuminate\Support\Str::uuid(),
            'sidang_id' => $sidang->id,
            'hakim_id' => $hakimId,
            'role_ketua' => $isKetuaHakim,
            'created_at' => $createdAtPivot[$hakimId] ?? now(),
            'updated_at' => now()
          ];
        }
        DB::table('pivot_sidang_hakim')->where('sidang_id', $sidang->id)->delete();
        DB::table('pivot_sidang_hakim')->insert($pivotHakimData);
      }

      // Update pivot tabel untuk ahli_id
      if ($request->has('ahli_id')) {
        $createdAtPivot = DB::table('pivot_sidang_ahli')
          ->where('sidang_id', $sidang->id)
          ->pluck('created_at', 'ahli_id')
          ->toArray();
        $pivotAhliData = [];
        foreach ($request->ahli_id as $ahliId) {
          $pivotAhliData[] = [
            'id' => \Illuminate\Support\Str::uuid(),
            'sidang_id' => $sidang->id,
            'ahli_id' => $ahliId,
            'created_at' => $createdAtPivot[$ahliId] ?? now(),
            'updated_at' => now()
          ];
        }
        DB::table('pivot_sidang_ahli')->where('sidang_id', $sidang->id)->delete();
        DB::table('pivot_sidang_ahli')->insert($pivotAhliData);
      }

      // Update pivot tabel untuk saksi_id
      if ($request->has('saksi_id')) {
        $createdAtPivot = DB::table('pivot_sidang_saksi')
          ->where('sidang_id', $sidang->id)
          ->pluck('created_at', 'saksi_id')
          ->toArray();
        $pivotSaksiData = [];
        foreach ($request->saksi_id as $saksiId) {
          $pivotSaksiData[] = [
            'id' => \Illuminate\Support\Str::uuid(),
            'sidang_id' => $sidang->id,
            'saksi_id' => $saksiId,
            'created_at' => $createdAtPivot[$saksiId] ?? now(),
            'updated_at' => now()
          ];
        }
        DB::table('pivot_sidang_saksi')->where('sidang_id', $sidang->id)->delete();
        DB::table('pivot_sidang_saksi')->insert($pivotSaksiData);
      }

      // Update pivot tabel untuk pengacara
      if ($request->has('nama_pengacara')) {
        $createdAtPivot = DB::table('pivot_sidang_pengacara')
          ->where('sidang_id', $sidang->id)
          ->pluck('created_at', 'nama_pengacara')
          ->toArray();
        $pivotPengacaraData = [];
        foreach ($request->nama_pengacara as $index => $namaPengacara) {
          $pivotPengacaraData[] = [
            'id' => \Illuminate\Support\Str::uuid(),
            'sidang_id' => $sidang->id,
            'nama_pengacara' => $namaPengacara,
            'jenis_pengacara' => $request->jenis_pengacara[$index],
            'created_at' => $createdAtPivot[$namaPengacara] ?? now(),
            'updated_at' => now()
          ];
        }
        DB::table('pivot_sidang_pengacara')->where('sidang_id', $sidang->id)->delete();
        DB::table('pivot_sidang_pengacara')->insert($pivotPengacaraData);
      }

      // Update histori vonis
      if ($request->has('hasil_vonis')) {
        $dataCratedAt = DB::table('histori_vonis')
          ->where('sidang_id', $sidang->id)
          ->pluck('created_at')
          ->toArray();
        $pivotVonisData = [
          'id' => \Illuminate\Support\Str::uuid()->toString(),
          'sidang_id' => $sidang->id,
          'hasil_vonis' => $request->input('hasil_vonis'),
          'masa_tahanan_tahun' => $request->input('masa_tahanan_tahun'),
          'masa_tahanan_bulan' => $request->input('masa_tahanan_bulan'),
          'masa_tahanan_hari' => $request->input('masa_tahanan_hari'),
          'created_at' => $dataCratedAt[0],
          'updated_at' => now()
        ];
        DB::table('histori_vonis')->insert($pivotVonisData);
      }

      // Update dokumen persidangan
      if ($request->hasFile('link_dokumen_persidangan')) {
        $dokumenPath = $request->file('link_dokumen_persidangan')->store('public/dokumen_persidangan');
        $dokumenPath = str_replace('public/', '', $dokumenPath);

        $pivotDokumenPersidangan = [
          'sidang_id' => $sidang->id,
          'nama_dokumen_persidangan' => $request->input('nama_dokumen_persidangan'),
          'link_dokumen_persidangan' => $dokumenPath,
          'created_at' => now(),
          'updated_at' => now()
        ];
        DB::table('dokumen_persidangan')->updateOrInsert(
          ['sidang_id' => $sidang->id],
          $pivotDokumenPersidangan
        );
      }

      DB::commit();

      return ApiResponse::updated();
    } catch (Exception $e) {
      DB::rollBack();
      return ApiResponse::error($e->getMessage(), 'Data sidang gagal diperbarui');
    }
  }




  // public function update(SidangRequest $request)
  // {
  //   DB::beginTransaction();
  //   try {
  //     $id = $request->input('sidang_id');
  //     $sidang = Sidang::findOrFail($id);
  //     $sidang->update($request->all());

  //     // Update pivot data if oditur_penuntut_id is present in request
  //     if ($request->has('oditur_penuntut_id')) {
  //       $createdAtPivot = DB::table('pivot_sidang_oditur')
  //         ->where('sidang_id', $sidang->id)
  //         ->pluck('created_at', 'oditur_penuntut_id')
  //         ->toArray();
  //       $this->updatePivotData($sidang, 'pivot_sidang_oditur', 'oditur_penuntut_id', 'role_ketua', $request->oditur_penuntut_id, $request->role_ketua, $createdAtPivot);
  //     }

  //     // Update pivot data for hakim
  //     if ($request->has('hakim_id')) {
  //       $createdAtPivot = DB::table('pivot_sidang_hakim')
  //         ->where('sidang_id', $sidang->id)
  //         ->pluck('created_at', 'hakim_id')
  //         ->toArray();
  //       $this->updatePivotData($sidang, 'pivot_sidang_hakim', 'hakim_id', 'role_ketua', $request->hakim_id, $request->role_ketua_hakim, $createdAtPivot);
  //     }

  //     // Update pivot data for ahli
  //     if ($request->has('ahli_id')) {
  //       $createdAtPivot = DB::table('pivot_sidang_ahli')
  //         ->where('sidang_id', $sidang->id)
  //         ->pluck('created_at', 'ahli_id')
  //         ->toArray();
  //       $this->updatePivotData($sidang, 'pivot_sidang_ahli', 'ahli_id', null, $request->ahli_id, null, $createdAtPivot);
  //     }

  //     // Update pivot data for saksi
  //     if ($request->has('saksi_id')) {
  //       $createdAtPivot = DB::table('pivot_sidang_saksi')
  //         ->where('sidang_id', $sidang->id)
  //         ->pluck('created_at', 'saksi_id')
  //         ->toArray();
  //       $this->updatePivotData($sidang, 'pivot_sidang_saksi', 'saksi_id', null, $request->saksi_id, null, $createdAtPivot);
  //     }

  //     DB::commit();
  //     return ApiResponse::created($sidang);
  //   } catch (\Exception $e) {
  //     DB::rollBack();
  //     return ApiResponse::error($e->getMessage(), 'Data sidang gagal diperbarui');
  //   }
  // }

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
      $this->softDeletePivotData('pivot_sidang_pengacara', $sidang->id);
      $this->softDeletePivotData('histori_vonis', $sidang->id);
      $this->softDeletePivotData('dokumen_persidangan', $sidang->id);

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
