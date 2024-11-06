<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::view('register','Auth.register')->name('register');
    Route::view('login','Auth.login')->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
