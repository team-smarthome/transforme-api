<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\kesatuanController;
use App\Http\Controllers\LokasiKesatuanController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\StatusKawinController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthSanctumMiddleware;
use App\Http\Controllers\TipeAsetController;
use App\Http\Controllers\LokasiOtmilController;

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
