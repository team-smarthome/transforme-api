<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutogateDualController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('autogate_dual_system', [AutogateDualController::class, 'index']);
  // Route::get('kasus/{id}', [AutogateDualController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('autogate_dual_system', [AutogateDualController::class, 'store']);
  Route::put('autogate_dual_system', [AutogateDualController::class, 'update']);
  Route::delete('autogate_dual_system', [AutogateDualController::class, 'destroy']);
});
