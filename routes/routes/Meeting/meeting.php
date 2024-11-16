<?php

use App\Http\Controllers\Meeting\MeetingController;
use App\Http\Middleware\UserMustBeVerified;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', UserMustBeVerified::class], 'prefix' => 'meetings'], function () {
    Route::view('/new', 'meeting.new')->name('meetings.new');
    Route::post('/neww', [MeetingController::class, 'store'])->name('meetings.store');
});
