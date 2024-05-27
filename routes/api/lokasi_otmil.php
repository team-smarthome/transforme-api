<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LokasiOtmilController;

Route::get('lokasi_otmil', [LokasiOtmilController::class, 'index']);
Route::post('lokasi_otmil', [LokasiOtmilController::class, 'store']);
Route::get('lokasi_otmil/{id}', [LokasiOtmilController::class, 'show']);
Route::put('lokasi_otmil/{id}', [LokasiOtmilController::class, 'update']);
Route::delete('lokasi_otmil/{id}', [LokasiOtmilController::class, 'destroy']);

Route::apiResource('lokasi_otmil', LokasiOtmilController::class);
