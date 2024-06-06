<?php

use App\Http\Controllers\JenisPerkaraController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('jenis_perkara', [JenisPerkaraController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('jenis_perkara', [JenisPerkaraController::class, 'index']);
    Route::post('jenis_perkara', [JenisPerkaraController::class, 'store']);
});
