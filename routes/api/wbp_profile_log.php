<?php

use App\Http\Controllers\WbpRegisterLogController;
use Illuminate\Support\Facades\Route;

Route::get('wbp_profile_log', [WbpRegisterLogController::class, 'index']);
?>
