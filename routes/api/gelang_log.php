<?php

use App\Http\Controllers\GelangLogController;
use App\Http\Middleware\AuthSanctumMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('gelang_log', [GelangLogController::class, 'index']);
    Route::post('gelang_log', [GelangLogController::class, 'store']);
    Route::put('gelang_log', [GelangLogController::class, 'update']);
    Route::delete('gelang_log', [GelangLogController::class, 'destroy']);
});
