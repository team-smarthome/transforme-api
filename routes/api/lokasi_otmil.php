<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LokasiOtmilController;

Route::get('lokasi-otmil', [LokasiOtmilController::class, 'index']);
Route::post('lokasi-otmil', [LokasiOtmilController::class, 'store']);
// Route::get('lokasi-otmil/{id}', [LokasiOtmilController::class, 'show']);
Route::put('lokasi-otmil', [LokasiOtmilController::class, 'update']);
Route::delete('lokasi-otmil', [LokasiOtmilController::class, 'destroy']);

Route::apiResource('lokasi-otmil', LokasiOtmilController::class);
