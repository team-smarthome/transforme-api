<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::post('login', [UserController::class, 'login']);
Route::prefix("master")
  ->middleware([AuthSanctumMiddleware::class])
  ->group(function () {
    Route::apiResource('agama', AgamaController::class);
  });
