<?php

use App\Http\Controllers\Meeting\MeetingController;
use App\Http\Middleware\UserMustBeVerified;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', UserMustBeVerified::class], 'prefix' => 'meetings'], function () {
    Route::view('/new', 'meeting.new')->name('meetings.new');
    Route::post('/new', [MeetingController::class, 'store'])->name('meetings.store');
    Route::get('/{meeting}', [MeetingController::class, 'show'])->name('meetings.show');
    Route::post('/{meeting}/changeName', [MeetingController::class, 'updateName'])->name('meetings.update.name');
});
