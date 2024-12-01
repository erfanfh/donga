<?php

namespace App\Actions\Meeting\Expense;

use App\Actions\User\UpdateUserBalanceAction;
use App\Models\Person;

class ShareExpensePriceAction {
    /**
     * @param $request
     *
     * @return void
     */
    public function execute($request): void
    {
        $updateUserBalance = new UpdateUserBalanceAction();

        $share = $request->price / count($request->people);

        $sponser = Person::find($request->sponsor);

        $updateUserBalance->execute($sponser, $request->price);

        foreach ($request->people as $person) {
            $user = Person::find($person);
            $updateUserBalance->execute($user, -$share);
        }

    }
}
