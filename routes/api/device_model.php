<?php

use App\Http\Controllers\DeviceModelController;
use Illuminate\Support\Facades\Route;

Route::get('device_model', [DeviceModelController::class, 'index']);
Route::post('device_model', [DeviceModelController::class, 'store']);
Route::put('device_model', [DeviceModelController::class, 'update']);
Route::delete('device_model', [DeviceModelController::class, 'destroy']);
?>
