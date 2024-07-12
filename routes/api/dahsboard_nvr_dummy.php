
<?php

use App\Http\Controllers\NVRDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('dahsboard_nvr_dummy', [NVRDashboardController::class, 'getDummyData']);
// });
?>
