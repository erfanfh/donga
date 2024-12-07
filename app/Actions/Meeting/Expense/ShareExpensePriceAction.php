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

        $price = $request->price;
        $peopleCount = count($request->people);
        $share = floor($price / $peopleCount);
        $remainder = $price - ($share * $peopleCount);

        $sponsor = Person::find($request->sponsor);

        $updateUserBalance->execute($sponsor, $price);

        foreach ($request->people as $index => $person) {
            $user = Person::find($person);

            $finalShare = $index === $peopleCount - 1 ? -($share + $remainder) : -$share;

            $updateUserBalance->execute($user, $finalShare);
        }
    }

}
