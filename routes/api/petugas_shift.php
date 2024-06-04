<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasShiftController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('petugas_shift', [petugasShiftController::class, 'index']);
  // Route::get('petugas', [petugasShiftController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('petugas_shift', [petugasShiftController::class, 'store']);
  Route::put('petugas_shift', [petugasShiftController::class, 'edit']);
  Route::delete('petugas_shift', [petugasShiftController::class, 'destroy']);
});
