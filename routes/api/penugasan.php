<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenugasanController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('penugasan', [PenugasanController::class, 'index']);
  // Route::get('petugas', [PenugasanController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('penugasan', [PenugasanController::class, 'store']);
  Route::put('penugasan', [PenugasanController::class, 'edit']);
  Route::delete('penugasan', [PenugasanController::class, 'destroy']);
});
