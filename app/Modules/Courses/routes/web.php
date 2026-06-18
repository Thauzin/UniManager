<?php

use App\Modules\Courses\Http\Controllers\CoursesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('courses', CoursesController::class)->names('courses');

    Route::post('courses/{id}/add-student', [CoursesController::class, 'addStudent'])
        ->name('courses.addStudent');
    Route::post('courses/{id}/remove-student', [CoursesController::class, 'removeStudent'])
        ->name('courses.removeStudent');
});
