<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GateParkingController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('gate_parking', [GateParkingController::class, 'index']);
  // Route::get('kasus/{id}', [GateParkingController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('gate_parking', [GateParkingController::class, 'store']);
  Route::put('gate_parking', [GateParkingController::class, 'update']);
  Route::delete('gate_parking', [GateParkingController::class, 'destroy']);
});
