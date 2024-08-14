<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('users', [UserController::class, 'index']);
  // Route::get('user', [UserController::class, 'show']);
});

Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
  Route::post('users', [UserController::class, 'store']);
  Route::put('users', [UserController::class, 'edit']);
  Route::delete('users', [UserController::class, 'destroy']);
});
