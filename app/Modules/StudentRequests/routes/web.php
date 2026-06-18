<?php

use App\Modules\StudentRequests\Http\Controllers\StudentRequestsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('student-requests', StudentRequestsController::class)->names('studentrequests');
});
