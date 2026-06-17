<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Configs\Http\Controllers\ConfigsController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('configs', ConfigsController::class)->names('configs');
});
