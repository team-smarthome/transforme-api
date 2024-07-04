<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisPerkaraController;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('jenis_perkara', [JenisPerkaraController::class, 'index']);
// });

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('jenis_perkara', [JenisPerkaraController::class, 'store']);
    Route::put('jenis_perkara', [JenisPerkaraController::class, 'update']);
    Route::delete('jenis_perkara', [JenisPerkaraController::class, 'destroy']);

});