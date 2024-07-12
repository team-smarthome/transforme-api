
<?php

use App\Http\Controllers\AccessDoorController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;

// Route::middleware([AuthSanctumMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('dahsboard_access_door_dummy', [AccessDoorController::class, 'getDummyData']);
// });
?>
