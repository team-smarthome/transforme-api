<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\AhliController;
use App\Http\Controllers\AktivitasGelangController;
use App\Http\Controllers\BidangKeahlianController;
use App\Http\Controllers\JenisPersidanganController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\JenisPidanaController;
use App\Http\Controllers\kesatuanController;
use App\Http\Controllers\LokasiKesatuanController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\StatusKawinController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthSanctumMiddleware;
use App\Http\Controllers\TipeAsetController;
use App\Http\Controllers\LokasiOtmilController;

Route::apiResource('agama', AgamaController::class);

// Route jenis-persidangan
Route::get('/jenis-persidangan', [JenisPersidanganController::class, 'index']);
Route::post('/jenis-persidangan', [JenisPersidanganController::class, 'store']);
Route::put('/jenis-persidangan/{id}', [JenisPersidanganController::class,'update']);
Route::delete('/jenis-persidangan/{id}', [JenisPersidanganController::class,'destroy']);

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
Route::post('/aktivitas-gelang', [AktivitasGelangController::class,'store']);

Route::prefix("master")
  ->middleware([AuthSanctumMiddleware::class])
  ->group(function () {
    Route::get('agama', [AgamaController::class, 'index']);
    Route::post('agama', [AgamaController::class, 'store']);
    Route::get('agama/{id}', [AgamaController::class, 'show']);
    Route::put('agama/{id}', [AgamaController::class, 'update']);
    Route::delete('agama/{id}', [AgamaController::class, 'destroy']);
  });

foreach ($routeFiles as $routeFile) {
    require $routeFile;
}
