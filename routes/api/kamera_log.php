<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KameraLogController;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('kamera_log', [KameraLogController::class, 'index']);
  // Route::get('kasus/{id}', [KameraLogController::class, 'show']);
// });

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('kamera_log', [KameraLogController::class, 'store']);
  // Route::put('kamera', [KameraLogController::class, 'update']);
  // Route::delete('kamera', [KameraLogController::class, 'destroy']);
// });
