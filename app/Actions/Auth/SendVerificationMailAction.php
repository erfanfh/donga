<?php

namespace App\Actions\Auth;

use App\Mail\SendVerificationCode;
use Illuminate\Support\Facades\Mail;

class SendVerificationMailAction {

    /**
     * Send verification code
     * @param string $email
     * @param int $code
     *
     * @return void
     */
    public function execute(string $email, int $code): void
    {
        Mail::to($email)->send(new SendVerificationCode($code));
    }
}
