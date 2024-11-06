<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\UserMustBeVerified;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::view('register','auth.register')->name('register');
    Route::view('login','auth.login')->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});

Route::group(['middleware' => ['auth', UserMustBeVerified::class]], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
