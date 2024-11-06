<?php

namespace App\Actions\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutUserAction {
    /**
     * Logout an authenticated user
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function execute(Request $request): void
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}
