<?php

use App\Modules\Users\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'access.level:1', 'nocache'])->group(function () {
    Route::resource('users', UserController::class)->names('users');
});

Route::middleware(['auth', 'verified', 'nocache'])->group(function () {
    Route::put('users/update-by-user/{id}', [UserController::class, 'updateByUser'])->name('updateByUser');
});
