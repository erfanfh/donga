<?php

use App\Http\Controllers\Support\SupportController;
use App\Http\Middleware\ClosedTickets;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
   Route::get('/support', [SupportController::class, 'index'])->name('support.index');
   Route::get('tickets/{ticket}', [SupportController::class, 'show'])->name('support.show');
   Route::post('tickets/{ticket}/close', [SupportController::class, 'closeTicket'])->name('support.close-ticket')->middleware(ClosedTickets::class);
});
