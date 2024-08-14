<?php

use App\Http\Controllers\FirmwareController;
use Illuminate\Support\Facades\Route;

Route::get('firmware', [FirmwareController::class, 'index']);
Route::post('firmware', [FirmwareController::class, 'store']);
Route::put('firmware', [FirmwareController::class, 'update']);
Route::delete('firmware', [FirmwareController::class, 'destroy']);
?>
