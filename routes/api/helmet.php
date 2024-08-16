<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelmetController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('helmet', [HelmetController::class, 'index']);
  Route::post('helmet', [HelmetController::class, 'store']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('helmet', [HelmetController::class, 'store']);
  Route::put('helmet', [HelmetController::class, 'update']);
  Route::delete('helmet', [HelmetController::class, 'destroy']);
});
