<?php

use App\Http\Controllers\RuanganController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;



    Route::get('ruangan-otmil', [RuanganController::class, 'index']);
    Route::post('ruangan-otmil', [RuanganController::class, 'store']);
    // Route::get('ruangan-otmil', [RuanganController::class, 'show']);
    Route::put('ruangan-otmil', [RuanganController::class, 'update']);
    Route::delete('ruangan-otmil', [RuanganController::class, 'destroy']);
    
