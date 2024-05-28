<?php

use App\Http\Controllers\ProvinsiController;
use Illuminate\Support\Facades\Route;

Route::get('provinsi', [ProvinsiController::class, 'index']);