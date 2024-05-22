<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\AhliController;
use App\Http\Controllers\JenisPersidanganController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\JenisPidanaController;

Route::apiResource('agama', AgamaController::class);
Route::get('/jenis-persidangan', [JenisPersidanganController::class, 'index']);
Route::post('/jenis-persidangan', [JenisPersidanganController::class, 'store']);

// Route provinsi
Route::get('/provinsi', [ProvinsiController::class, 'index']);

// Route jenis-pidana
Route::get('/jenis-pidana', [JenisPidanaController::class,'index']);
Route::post('/jenis-pidana', [JenisPidanaController::class, 'store']);
Route::put('/jenis-pidana', [JenisPidanaController::class,'update']);
Route::delete('/jenis-pidana/{id}', [JenisPidanaController::class, 'destroy']);

// Route ahli
Route::get('/ahli', [AhliController::class,'index']);
Route::post('/ahli', [AhliController::class, 'store']);
Route::put('/ahli', [AhliController::class,'update']);
Route::delete('/ahli/{id}', [AhliController::class, 'destroy']);

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
