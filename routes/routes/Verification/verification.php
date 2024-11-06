<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\UserMustBeUnverified;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', UserMustBeUnVerified::class]], function () {
    Route::get('/verify', [AuthController::class, 'verify'])->name('verify');
    Route::post('/verify', [AuthController::class, 'verifyPost'])->name('verify.post');
    Route::get('/verify/resend', [AuthController::class, 'resend'])->name('verify.resend');
    Route::get('/verify/change-email', [AuthController::class, 'changeEmail'])->name('verify.change-email');
    Route::post('/verify/change-email', [AuthController::class, 'changeEmailPost'])->name('verify.change-email.post');
});
