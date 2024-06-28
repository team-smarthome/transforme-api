<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KameraTersimpanController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('kamera_tersimpan', [KameraTersimpanController::class, 'index']);
  // Route::get('kasus/{id}', [KameraTersimpanController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('kamera_tersimpan', [KameraTersimpanController::class, 'store']);
  Route::put('kamera_tersimpan', [KameraTersimpanController::class, 'update']);
  Route::delete('kamera_tersimpan', [KameraTersimpanController::class, 'destroy']);
});
