<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LokasiKesatuanController;

Route::get('lokasi-kesatuan', [LokasiKesatuanController::class, 'index']);
Route::post('lokasi-kesatuan', [LokasiKesatuanController::class, 'store']);
