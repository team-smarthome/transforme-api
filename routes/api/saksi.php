<?php

use App\Http\Controllers\SaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('saksi', [SaksiController::class, 'index']);
    Route::post('saksi', [SaksiController::class, 'store']);
    Route::put('saksi', [SaksiController::class, 'update']);
    Route::delete('saksi', [SaksiController::class, 'destroy']);
});

// Route::middleware([AuthSanctumMiddleware::class . ':operator'])->group(function () {
//     Route::get('saksi', [SaksiController::class, 'index']);
// });
