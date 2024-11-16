<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Middleware\UserMustBeVerified;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', UserMustBeVerified::class]], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
