<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaceRecMapController;
use App\Http\Middleware\AuthSanctumMiddleware;

    Route::get('face_rec', [FaceRecMapController::class, 'index']);

    Route::post('face_rec', [FaceRecMapController::class, 'store']);
    Route::put('face_rec', [FaceRecMapController::class, 'update']);
    Route::delete('face_rec', [FaceRecMapController::class, 'destroy']);

