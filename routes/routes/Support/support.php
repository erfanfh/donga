<?php

use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
   Route::view('/support', 'support.index')->name('support.index');
});
