<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('schedule', [ScheduleController::class, 'index']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('schedule', [ScheduleController::class, 'store']);
  Route::put('schedule', [ScheduleController::class, 'update']);
  Route::delete('schedule', [ScheduleController::class, 'destroy']);
});
