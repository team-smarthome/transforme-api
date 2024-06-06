<?php

use App\Http\Controllers\RuanganController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;



    Route::get('ruangan_otmil', [RuanganController::class, 'index']);
    Route::post('ruangan_otmil', [RuanganController::class, 'store']);
    // Route::get('ruangan_otmil', [RuanganController::class, 'show']);
    Route::put('ruangan_otmil', [RuanganController::class, 'update']);
    Route::delete('ruangan_otmil', [RuanganController::class, 'destroy']);
    
