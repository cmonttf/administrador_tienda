<?php

use App\Http\Controllers\Api\DashboardApiController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/dashboard',
    [DashboardApiController::class, 'index']
);
