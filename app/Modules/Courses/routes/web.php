<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Courses\Http\Controllers\CoursesController;

Route::middleware(['auth', 'verified'])->group(function () {
    });
    Route::resource('courses', CoursesController::class)->names('courses');
