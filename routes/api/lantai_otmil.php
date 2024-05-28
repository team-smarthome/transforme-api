<?php

use App\Http\Controllers\LantaiController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;



    Route::get('lantai-otmil', [LantaiController::class, 'index']);
    Route::post('lantai-otmil', [LantaiController::class, 'store']);
    // Route::get('lantai-otmil', [LantaiController::class, 'show']);
    Route::put('lantai-otmil', [LantaiController::class, 'update']);
    Route::delete('lantai-otmil', [LantaiController::class, 'destroy']);
    
