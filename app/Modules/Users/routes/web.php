<?php

use App\Modules\Users\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'access.level:1', 'nocache'])->group(function () {
    Route::resource('users', UserController::class)->names('users');
});