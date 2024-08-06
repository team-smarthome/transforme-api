<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SelfRegMapController;
use App\Http\Middleware\AuthSanctumMiddleware;

    Route::get('self_rec', [SelfRegMapController::class, 'index']);

    Route::post('self_rec', [SelfRegMapController::class, 'store']);
    Route::put('self_rec', [SelfRegMapController::class, 'update']);
    Route::delete('self_rec', [SelfRegMapController::class, 'destroy']);

