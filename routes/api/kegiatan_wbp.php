<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KegiatanWbpController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('kegiatan_wbp', [KegiatanWbpController::class, 'index']);
  // Route::get('kegiatan', [KegiatanWbpController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('kegiatan_wbp', [KegiatanWbpController::class, 'store']);
  Route::put('kegiatan_wbp', [KegiatanWbpController::class, 'update']);
  Route::delete('kegiatan_wbp', [KegiatanWbpController::class, 'destroy']);
});
