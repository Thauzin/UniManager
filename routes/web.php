<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login/auth', [LoginController::class, 'authenticate'])->name('login.validar');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');