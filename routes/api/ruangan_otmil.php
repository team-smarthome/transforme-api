<?php

use App\Http\Controllers\RuanganOtmilController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;



    Route::get('ruangan_otmil', [RuanganOtmilController::class, 'index']);
    Route::post('ruangan_otmil', [RuanganOtmilController::class, 'store']);
    // Route::get('ruangan_otmil', [RuanganOtmilController::class, 'show']);
    Route::put('ruangan_otmil', [RuanganOtmilController::class, 'update']);
    Route::delete('ruangan_otmil', [RuanganOtmilController::class, 'destroy']);
    
