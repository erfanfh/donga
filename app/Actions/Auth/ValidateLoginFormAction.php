<?php

namespace App\Actions\Auth;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;

class ValidateLoginFormAction {

    /**
     * Validate the credentials
     *
     * @param \App\Http\Requests\UserLoginRequest $request
     *
     * @return bool
     */
    public function execute(UserLoginRequest $request): bool
    {
        $validated = $request->validated();

        return Auth::attempt($validated);
    }
}
