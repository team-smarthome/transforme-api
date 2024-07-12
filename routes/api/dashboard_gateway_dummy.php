
<?php

use App\Http\Controllers\GatewayDashboardDummyController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('dahsboard_gateway_dummy', [GatewayDashboardDummyController::class, 'getDummyData']);
// });
?>
