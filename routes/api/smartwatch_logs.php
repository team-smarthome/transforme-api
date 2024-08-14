<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SidangController;
use App\Http\Controllers\SmartwatchLogController;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('smartwatch-logs', [SmartwatchLogController::class, 'index']);
  // Route::get('sidang', [SidangController::class, 'show']);
});

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
//   Route::post('sidang', [SidangController::class, 'store']);
//   Route::put('sidang', [SidangController::class, 'update']);
//   Route::delete('sidang', [SidangController::class, 'destroy']);
// });
