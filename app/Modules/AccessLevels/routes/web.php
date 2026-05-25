<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AccessLevels\Http\Controllers\AccessLevelsController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('accesslevels', AccessLevelsController::class)->names('accesslevels');
});
