<?php

use App\Http\Controllers\LantaiController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;



    Route::get('lantai_otmil', [LantaiController::class, 'index']);
    Route::post('lantai_otmil', [LantaiController::class, 'store']);
    // Route::get('lantai_otmil', [LantaiController::class, 'show']);
    Route::put('lantai_otmil', [LantaiController::class, 'update']);
    Route::delete('lantai_otmil', [LantaiController::class, 'destroy']);
    
