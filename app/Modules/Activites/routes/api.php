<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Activites\Http\Controllers\ActivitesController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('activites', ActivitesController::class)->names('activites');
});
