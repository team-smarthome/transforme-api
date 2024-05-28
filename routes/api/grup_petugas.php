<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrupPetugasController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('grup-petugas', [GrupPetugasController::class, 'index']);
  // Route::get('grup-petugas', [GrupPetugasController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('grup-petugas', [GrupPetugasController::class, 'store']);
  Route::put('grup-petugas', [GrupPetugasController::class, 'update']);
  Route::delete('grup-petugas', [GrupPetugasController::class, 'destroy']);
});
