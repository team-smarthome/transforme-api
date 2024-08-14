
<?php

use App\Http\Controllers\TVDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('dahsboard_tv_dummy', [TVDashboardController::class, 'getDummyData']);
// });
?>
