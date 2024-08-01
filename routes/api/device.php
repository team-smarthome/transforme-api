<?php

use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;

Route::get('device', [DeviceController::class, 'index']);
Route::post('device', [DeviceController::class, 'store']);
Route::put('device', [DeviceController::class, 'update']);
Route::delete('device', [DeviceController::class, 'destroy']);
?>
