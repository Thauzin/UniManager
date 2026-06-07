<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SecretaryRequests\Http\Controllers\SecretaryRequestsController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    
});

Route::apiResource('secretaryrequests', SecretaryRequestsController::class)->names('secretaryrequests');
