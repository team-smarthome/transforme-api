<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XrayMechineController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('xray_mechine', [XrayMechineController::class, 'index']);
  // Route::get('kasus/{id}', [XrayMechineController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('xray_mechine', [XrayMechineController::class, 'store']);
  Route::put('xray_mechine', [XrayMechineController::class, 'update']);
  Route::delete('xray_mechine', [XrayMechineController::class, 'destroy']);
});
