<?php

use Illuminate\Support\Facades\Route;
use App\Modules\CourseAreas\Http\Controllers\CourseAreasController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('courseareas', CourseAreasController::class)->names('courseareas');
});
