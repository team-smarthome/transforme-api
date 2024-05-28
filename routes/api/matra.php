<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;
use App\Http\Controllers\MatraController;

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('matra', [MatraController::class, 'index']);
    Route::post('matra', [MatraController::class, 'store']);
    // Route::get('matra', [MatraController::class, 'show']);
    Route::put('matra', [MatraController::class, 'update']);
    // Route::delete('matra/{id}', [MatraController::class, 'destroy']);
});
