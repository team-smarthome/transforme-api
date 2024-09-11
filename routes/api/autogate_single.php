<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutogateSingleController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('autogate_single', [AutogateSingleController::class, 'index']);
  // Route::get('kasus/{id}', [AutogateSingleController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('autogate_single', [AutogateSingleController::class, 'store']);
  Route::put('autogate_single', [AutogateSingleController::class, 'update']);
  Route::delete('autogate_single', [AutogateSingleController::class, 'destroy']);
});
