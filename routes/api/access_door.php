<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessDoorMapController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('access_door', [AccessDoorMapController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('access_door', [AccessDoorMapController::class, 'store']);
  Route::put('access_door', [AccessDoorMapController::class, 'update']);
  Route::delete('access_door', [AccessDoorMapController::class, 'destroy']);
});
