<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('petugas', [PetugasController::class, 'index']);
  // Route::get('petugas', [PetugasController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('petugas', [PetugasController::class, 'store']);
  Route::put('petugas', [PetugasController::class, 'edit']);
  Route::delete('petugas', [PetugasController::class, 'destroy']);
});
