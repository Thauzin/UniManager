<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SecretaryRequests\Http\Controllers\SecretaryRequestsController;

Route::middleware(['auth', 'verified'])->group(function () {
    
});
Route::resource('secretaryrequests', SecretaryRequestsController::class)->names('secretaryrequests');
