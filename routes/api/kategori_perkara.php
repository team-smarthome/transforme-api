<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriPerkaraController;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
Route::get('kategori_perkara', [KategoriPerkaraController::class, 'index']);
// });

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
Route::post('kategori_perkara', [KategoriPerkaraController::class, 'store']);
Route::put('kategori_perkara', [KategoriPerkaraController::class, 'update']);
Route::delete('kategori_perkara', [KategoriPerkaraController::class, 'destroy']);
// });
