<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmergencyPushButtonController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('emergency_push_button', [EmergencyPushButtonController::class, 'index']);
  // Route::get('kasus/{id}', [EmergencyPushButtonController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('emergency_push_button', [EmergencyPushButtonController::class, 'store']);
  Route::put('emergency_push_button', [EmergencyPushButtonController::class, 'update']);
  Route::delete('emergency_push_button', [EmergencyPushButtonController::class, 'destroy']);
});