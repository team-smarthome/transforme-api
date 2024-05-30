<?php

use App\Http\Controllers\JenisPerkaraController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('jenis-perkara', [JenisPerkaraController::class, 'index']);
    // Route::get('kategori-perkara/{id}', [JenisPerkaraController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('jenis-perkara', [JenisPerkaraController::class, 'store']);
});