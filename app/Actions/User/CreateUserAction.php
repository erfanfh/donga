<?php

namespace App\Actions\User;

use App\Models\User;

class CreateUserAction {
    public function execute(array $user) : User
    {
        return User::create($user);
    }
}
