<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekapVonisController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('rekap_vonis_wbp', [RekapVonisController::class, 'index']);
});