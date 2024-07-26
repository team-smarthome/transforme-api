<?php

use App\Http\Controllers\FirmwareController;
use Illuminate\Support\Facades\Route;

Route::prefix('firmware')->group(function () {
    Route::get('/', [FirmwareController::class, 'index']);
    Route::post('/', [FirmwareController::class, 'store']);
    Route::put('/', [FirmwareController::class, 'update']);
    Route::delete('/', [FirmwareController::class, 'destroy']);
});
