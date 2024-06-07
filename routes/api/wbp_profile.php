
<?php

use App\Http\Controllers\WbpProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('wbp-profile', [WbpProfileController::class, 'index']);
    Route::post('wbp-profile', [WbpProfileController::class, 'create']);
    Route::put('wbp-profile', [WbpProfileController::class, 'update']);
    Route::delete('wbp-profile', [WbpProfileController::class, 'destroy']);
// });
?>
