<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KameraReadByLocationControoler;
use App\Http\Middleware\AuthSanctumMiddleware;

Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
  Route::get('kamera_read_by_location', [KameraReadByLocationControoler::class, 'index']);
  // Route::get('kasus/{id}', [KameraReadByLocationControoler::class, 'show']);
});

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
//   Route::post('kamera_tersimpan', [KameraReadByLocationControoler::class, 'store']);
//   Route::put('kamera_tersimpan', [KameraReadByLocationControoler::class, 'update']);
//   Route::delete('kamera_tersimpan', [KameraReadByLocationControoler::class, 'destroy']);
// });
