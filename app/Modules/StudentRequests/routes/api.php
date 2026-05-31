<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StudentRequests\Http\Controllers\StudentRequestsController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('studentrequests', StudentRequestsController::class)->names('studentrequests');
});
