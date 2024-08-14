<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengunjungController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('pengunjung', [PengunjungController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('pengunjung', [PengunjungController::class, 'store']);
    Route::put('pengunjung', [PengunjungController::class, 'update']);
    Route::delete('pengunjung', [PengunjungController::class, 'destroy']);
});