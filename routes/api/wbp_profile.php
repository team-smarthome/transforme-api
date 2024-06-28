
<?php

use App\Http\Controllers\WbpProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('wbp_profile', [WbpProfileController::class, 'index']);
    Route::post('wbp_profile', [WbpProfileController::class, 'create']);
    Route::put('wbp_profile', [WbpProfileController::class, 'update']);
    Route::delete('wbp_profile', [WbpProfileController::class, 'destroy']);
// });
?>
