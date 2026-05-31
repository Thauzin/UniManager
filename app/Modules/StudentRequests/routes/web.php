<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StudentRequests\Http\Controllers\StudentRequestsController;

Route::middleware(['auth', 'verified'])->group(function () {
    
});
Route::resource('studentrequests', StudentRequestsController::class)->names('studentrequests');