<?php

use Illuminate\Support\Facades\Route;
use App\Modules\CourseAreas\Http\Controllers\CourseAreasController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('courseareas', CourseAreasController::class)->names('courseareas');
});
