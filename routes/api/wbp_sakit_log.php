<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WbpSakitLogController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('wbp_sakit_log', [WbpSakitLogController::class, 'index']);
  // Route::get('zona/{id}', [WbpSakitLogController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  // Route::post('zona', [WbpSakitLogController::class, 'store']);
});
