<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KegiatanController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('kegiatan', [KegiatanController::class, 'index']);
  // Route::get('kegiatan', [KegiatanController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('kegiatan', [KegiatanController::class, 'store']);
  Route::put('kegiatan', [KegiatanController::class, 'update']);
  Route::delete('kegiatan', [KegiatanController::class, 'destroy']);
});
