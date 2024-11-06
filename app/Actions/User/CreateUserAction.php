<?php

namespace App\Actions\User;

use App\Models\User;

class CreateUserAction {
    /**
     * Create a new user model
     *
     * @param array $user
     *
     * @return \App\Models\User
     */
    public function execute(array $user) : User
    {
        return User::create($user);
    }
}
