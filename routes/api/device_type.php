<?php

use App\Http\Controllers\DeviceTypeController;
use Illuminate\Support\Facades\Route;

Route::get('device_type', [DeviceTypeController::class, 'index']);
Route::post('device_type', [DeviceTypeController::class, 'store']);
Route::put('device_type', [DeviceTypeController::class, 'update']);
Route::delete('device_type', [DeviceTypeController::class, 'destroy']);
?>
