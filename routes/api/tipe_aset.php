<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipeAsetController;

Route::get('tipe_aset', [TipeAsetController::class, 'index']);
Route::post('tipe_aset', [TipeAsetController::class, 'store']);
Route::get('tipe_aset/{id}', [TipeAsetController::class, 'show']);
Route::put('tipe_aset/{id}', [TipeAsetController::class, 'update']);
Route::delete('tipe_aset/{id}', [TipeAsetController::class, 'destroy']);
