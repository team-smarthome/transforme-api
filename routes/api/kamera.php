<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KameraController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('kamera', [KameraController::class, 'index']);
  // Route::get('kasus/{id}', [KameraController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('kamera', [KameraController::class, 'store']);
  Route::put('kamera', [KameraController::class, 'update']);
  Route::delete('kamera', [KameraController::class, 'destroy']);
});
