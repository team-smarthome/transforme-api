<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NvrController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('nvr', [NvrController::class, 'index']);
  // Route::get('kasus/{id}', [NvrController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('nvr', [NvrController::class, 'store']);
  Route::put('nvr', [NvrController::class, 'update']);
  Route::delete('nvr', [NvrController::class, 'destroy']);
});
