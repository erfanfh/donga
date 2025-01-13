<?php

use App\Http\Controllers\User\UserController;
use App\Http\Middleware\UserMustBeVerified;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', UserMustBeVerified::class], 'prefix' => 'user'], function () {
    Route::view('/profile', 'user.profile')->name('user.profile');
    Route::post('/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::view('/change-password', 'user.changePassword')->name('user.change-password');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('user.change-password-post');
});
