<?php

use App\Http\Controllers\Auth\LoginController;
use App\Modules\Inventories\Models\Inventory;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (! auth()->check()) {
        return redirect()->route('login');
    }

    $user = auth()->user();

    if ($user) {
        return redirect()->route('users.index');
    }

    return redirect()->route('login');

})->name('index');

Route::get('/login', [LoginController::class, 'index'])
    ->name('login');

Route::post('/login/auth', [LoginController::class, 'authenticate'])
    ->name('login.validar');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');
