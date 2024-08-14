<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendidikanController;

Route::get('pendidikan', [PendidikanController::class, 'index']);
Route::post('pendidikan', [PendidikanController::class, 'store']);

