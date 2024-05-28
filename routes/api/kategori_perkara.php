<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriPerkaraController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('kategori-perkara', [KategoriPerkaraController::class, 'index']);
    Route::get('kategori-perkara/{id}', [KategoriPerkaraController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('kategori-perkara', [KategoriPerkaraController::class, 'store']);
    Route::put('kategori-perkara/{id}', [KategoriPerkaraController::class, 'update']);
    Route::delete('kategori-perkara/{id}', [KategoriPerkaraController::class, 'destroy']);
});