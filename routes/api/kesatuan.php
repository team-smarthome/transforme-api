<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kesatuanController;

Route::get('kesatuan', [kesatuanController::class, 'index']);
Route::post('kesatuan', [kesatuanController::class, 'store']);
