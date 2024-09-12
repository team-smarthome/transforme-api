<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartLockerController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('smartlocker', [SmartLockerController::class, 'index']);
  // Route::get('kasus/{id}', [SmartLockerController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('smartlocker', [SmartLockerController::class, 'store']);
  Route::put('smartlocker', [SmartLockerController::class, 'update']);
  Route::delete('smartlocker', [SmartLockerController::class, 'destroy']);
});
