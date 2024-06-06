<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrupPetugasController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('grup_petugas', [GrupPetugasController::class, 'index']);
  // Route::get('grup_petugas', [GrupPetugasController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('grup_petugas', [GrupPetugasController::class, 'store']);
  Route::put('grup_petugas', [GrupPetugasController::class, 'update']);
  Route::delete('grup_petugas', [GrupPetugasController::class, 'destroy']);
});
