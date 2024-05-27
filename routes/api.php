<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\AhliController;
use App\Http\Controllers\AktivitasGelangController;
use App\Http\Controllers\BidangKeahlianController;
use App\Http\Controllers\HunianWbpOtmilController;
use App\Http\Controllers\JaksaController;
use App\Http\Controllers\JenisPerkaraController;
use App\Http\Controllers\JenisPersidanganController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\JenisPidanaController;
use App\Http\Controllers\KategoriPerkaraController;
use App\Http\Controllers\kesatuanController;
use App\Http\Controllers\LokasiKesatuanController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\StatusKawinController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthSanctumMiddleware;
use App\Http\Controllers\TipeAsetController;
use App\Http\Controllers\LokasiOtmilController;
use App\Http\Controllers\ZonaController;

Route::apiResource('agama', AgamaController::class);

// Route jenis-persidangan
// Route::get('/jenis-persidangan', [JenisPersidanganController::class, 'index']);
// Route::post('/jenis-persidangan', [JenisPersidanganController::class, 'store']);
// Route::put('/jenis-persidangan/{id}', [JenisPersidanganController::class,'update']);
// Route::delete('/jenis-persidangan/{id}', [JenisPersidanganController::class,'destroy']);

// Route provinsi
Route::get('/provinsi', [ProvinsiController::class, 'index']);

// Route jenis-pidana
Route::get('/jenis-pidana', [JenisPidanaController::class,'index']);
Route::post('/jenis-pidana', [JenisPidanaController::class, 'store']);
Route::put('/jenis-pidana/{id}', [JenisPidanaController::class,'update']);
Route::delete('/jenis-pidana/{id}', [JenisPidanaController::class, 'destroy']);

// Route ahli
Route::get('/ahli', [AhliController::class,'index']);
Route::post('/ahli', [AhliController::class, 'store']);
Route::put('/ahli/{id}', [AhliController::class,'update']);
Route::delete('/ahli/{id}', [AhliController::class, 'destroy']);

// Route bidang-keahlian
Route::get('/bidang-keahlian', [BidangKeahlianController::class,'index']);
Route::post('/bidang-keahlian', [BidangKeahlianController::class,'store']);
Route::put('/bidang-keahlian/{id}', [BidangKeahlianController::class,'update']);
Route::delete('/bidang-keahlian/{id}', [BidangKeahlianController::class,'destroy']);

// Route aktivitas-gelang
Route::get('/aktivitas-gelang', [AktivitasGelangController::class,'index']);
Route::post('/aktivitas-gelang', [AktivitasGelangController::class,'']);

// Route zona
Route::get('/zona', [ZonaController::class,'index']);
Route::post('/zona', [ZonaController::class,'store']);

// Route kategori-perkara
Route::get('/kategori-perkara', [KategoriPerkaraController::class,'index']);
Route::post('/kategori-perkara', [KategoriPerkaraController::class,'store']);

// Route jenis-perkara
Route::get('/jenis-perkara', [JenisPerkaraController::class,'index']);
Route::post('/jenis-perkara', [JenisPerkaraController::class,'store']);

// Route jaksa
Route::get('/jaksa', [JaksaController::class,'index']);
Route::post('/jaksa', [JaksaController::class, 'store']);
Route::put('/jaksa/{id}', [JaksaController::class,'update']);
Route::delete('/jaksa/{id}', [JaksaController::class, 'destroy']);

// Route hunian-wbp-otmil
Route::get('/hunian-wbp-otmil', [HunianWbpOtmilController::class,'index']);
Route::post('/hunian-wbp-otmil', [HunianWbpOtmilController::class, 'store']);
Route::put('/hunian-wbp-otmil/{id}', [HunianWbpOtmilController::class,'update']);
Route::delete('/hunian-wbp-otmil/{id}', [HunianWbpOtmilController::class, 'destroy']);

Route::prefix("master")
  ->middleware([AuthSanctumMiddleware::class])
  ->group(function () {
    Route::get('agama', [AgamaController::class, 'index']);
    Route::post('agama', [AgamaController::class, 'store']);
    Route::get('agama/{id}', [AgamaController::class, 'show']);
    Route::put('agama/{id}', [AgamaController::class, 'update']);
    Route::delete('agama/{id}', [AgamaController::class, 'destroy']);
  });


Route::post('login', [UserController::class, 'login']);
Route::get('tipe_aset', [TipeAsetController::class, 'index']);
Route::post('tipe_aset', [TipeAsetController::class, 'store']);
Route::get('tipe_aset/{id}', [TipeAsetController::class, 'show']);
Route::put('tipe_aset/{id}', [TipeAsetController::class, 'update']);
Route::delete('tipe_aset/{id}', [TipeAsetController::class, 'destroy']);
Route::get('lokasi_otmil', [LokasiOtmilController::class, 'index']);
Route::post('lokasi_otmil', [LokasiOtmilController::class, 'store']);
Route::get('lokasi_otmil/{id}', [LokasiOtmilController::class, 'show']);
Route::put('lokasi_otmil/{id}', [LokasiOtmilController::class, 'update']);
Route::delete('lokasi_otmil/{id}', [LokasiOtmilController::class, 'destroy']);

Route::apiResource('lokasi_otmil', LokasiOtmilController::class);
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/pangkat', [PangkatController::class, 'index']);
Route::post('/pangkat', [PangkatController::class, 'store']);

Route::get('/lokasi-kesatuan', [LokasiKesatuanController::class, 'index']);
Route::post('/lokasi-kesatuan', [LokasiKesatuanController::class, 'store']);

Route::get('/kesatuan', [kesatuanController::class, 'index']);
Route::post('/kesatuan', [kesatuanController::class, 'store']);

Route::get('/status-kawin', [StatusKawinController::class, 'index']);
Route::post('/status-kawin', [StatusKawinController::class, 'store']);

Route::get('/pendidikan', [PendidikanController::class, 'index']);
Route::post('/pendidikan', [PendidikanController::class, 'store']);

// Load all routes in the 'api' folder dynamically
$routeFiles = glob(__DIR__ . '/api/*.php');

foreach ($routeFiles as $routeFile) {
    require $routeFile;
}