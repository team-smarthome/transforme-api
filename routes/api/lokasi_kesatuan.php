<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LokasiKesatuanController;

Route::get('lokasi_kesatuan', [LokasiKesatuanController::class, 'index']);
Route::post('lokasi_kesatuan', [LokasiKesatuanController::class, 'store']);
