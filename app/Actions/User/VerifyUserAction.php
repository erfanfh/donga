<?php

namespace App\Actions\User;

class VerifyUserAction {
    /**
     * Verify the user
     * @return void
     */
    public function execute(): void
    {
        auth()->user()->email_verified_at = now();

        auth()->user()->save();
    }
}
