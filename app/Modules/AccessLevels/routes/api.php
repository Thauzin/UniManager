<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AccessLevels\Http\Controllers\AccessLevelsController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('accesslevels', AccessLevelsController::class)->names('accesslevels');
});
