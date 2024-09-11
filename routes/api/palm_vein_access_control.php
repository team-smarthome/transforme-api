<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PalmVeinController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('palm_vein_access_control', [PalmVeinController::class, 'index']);
  // Route::get('kasus/{id}', [PalmVeinController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('palm_vein_access_control', [PalmVeinController::class, 'store']);
  Route::put('palm_vein_access_control', [PalmVeinController::class, 'update']);
  Route::delete('palm_vein_access_control', [PalmVeinController::class, 'destroy']);
});
