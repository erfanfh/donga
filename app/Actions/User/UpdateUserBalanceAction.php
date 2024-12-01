<?php

namespace App\Actions\User;

use App\Models\Person;

class UpdateUserBalanceAction {
    /**
     * @param \App\Models\Person $person
     * @param $request
     *
     * @return void
     */
    public function execute(Person $person, $price): void
    {
        $person->update(['balance' => $person->balance + $price]);
    }
}
