<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokumenBapController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('dokumen_bap', [DokumenBapController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('dokumen_bap', [DokumenBapController::class, 'store']);
    Route::put('dokumen_bap', [DokumenBapController::class, 'update']);
    Route::delete('dokumen_bap', [DokumenBapController::class, 'destroy']);

});