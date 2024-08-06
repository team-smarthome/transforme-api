<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NvrController;
use App\Http\Middleware\AuthSanctumMiddleware;

    Route::get('nvr', [NvrController::class, 'index']);

    Route::post('nvr', [NvrController::class, 'store']);
    Route::put('nvr', [NvrController::class, 'update']);
    Route::delete('nvr', [NvrController::class, 'destroy']);

