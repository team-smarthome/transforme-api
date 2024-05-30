<?php

use App\Http\Controllers\AksesRuanganController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;



    Route::get('akses-ruangan', [AksesRuanganController::class, 'index']);
    Route::post('akses-ruangan', [AksesRuanganController::class, 'create']);
    // Route::get('akses-ruangan', [AksesRuanganController::class, 'show']);
    Route::put('akses-ruangan', [AksesRuanganController::class, 'update']);
    Route::delete('akses-ruangan', [AksesRuanganController::class, 'destroy']);
    
