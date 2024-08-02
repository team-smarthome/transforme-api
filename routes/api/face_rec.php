<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaceRecMapController;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':operator,admin,superadmin'])->group(function () {
    Route::get('face_rec', [FaceRecMapController::class, 'index']);

// });

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::post('face_rec', [FaceRecMapController::class, 'store']);
    Route::put('face_rec', [FaceRecMapController::class, 'update']);
    Route::delete('face_rec', [FaceRecMapController::class, 'destroy']);
// });
