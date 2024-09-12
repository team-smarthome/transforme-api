<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationKiosController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('registration_kios', [RegistrationKiosController::class, 'index']);
  // Route::get('kasus/{id}', [RegistrationKiosController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('registration_kios', [RegistrationKiosController::class, 'store']);
  Route::put('registration_kios', [RegistrationKiosController::class, 'update']);
  Route::delete('registration_kios', [RegistrationKiosController::class, 'destroy']);
});