<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\JenisPersidanganController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\JenisPidanaController;

Route::apiResource('agama', AgamaController::class);
Route::get('/jenis_persidangan', [JenisPersidanganController::class, 'index']);
Route::get('/provinsi', [ProvinsiController::class, 'index']);
Route::get('/jenis_pidana', [JenisPidanaController::class,'index']);
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
