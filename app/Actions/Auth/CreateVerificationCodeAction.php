<?php

namespace App\Actions\Auth;

use App\Models\Code;

class CreateVerificationCodeAction
{
    /**
     * Generate a random code and place it in database
     *
     * @return int
     */
    public function execute(): int
    {
        $codeNum = rand(1000, 9999);

        auth()->user()->codes()->create([
            'code' => $codeNum,
            'expired_at' => now()->addHours(2)
        ]);

        return $codeNum;
    }
}
