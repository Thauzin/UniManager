<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Configs\Http\Controllers\ConfigsController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('configs', ConfigsController::class)->names('configs');
});
