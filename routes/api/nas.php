<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NasController;
use App\Http\Middleware\AuthSanctumMiddleware;

    Route::get('nas', [NasController::class, 'index']);

    Route::post('nas', [NasController::class, 'store']);
    Route::put('nas', [NasController::class, 'update']);
    Route::delete('nas', [NasController::class, 'destroy']);

