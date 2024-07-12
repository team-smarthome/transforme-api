
<?php

use App\Http\Controllers\RoutesControllerDummy;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('dahsboard_routes_dummy', [RoutesControllerDummy::class, 'getDummyData']);
// });
?>
