<?php

use App\Http\Controllers\AksesRuanganController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;



    Route::get('akses_ruangan', [AksesRuanganController::class, 'index']);
    Route::post('akses_ruangan', [AksesRuanganController::class, 'create']);
    // Route::get('akses_ruangan', [AksesRuanganController::class, 'show']);
    Route::put('akses_ruangan', [AksesRuanganController::class, 'update']);
    Route::delete('akses_ruangan', [AksesRuanganController::class, 'destroy']);
    
