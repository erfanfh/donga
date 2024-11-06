<?php

namespace App\Actions\User;

use Illuminate\Http\Request;

class ChangeUserEmailAction {
    /**
     * Change the user's email
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function execute(Request $request): void
    {
        auth()->user()->update([
            'email' => $request->email,
        ]);
    }
}
