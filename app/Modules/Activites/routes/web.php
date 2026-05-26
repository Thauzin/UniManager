<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Activites\Http\Controllers\ActivitesController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('activites', ActivitesController::class)->names('activites');
    });
    