<?php

namespace App\Actions\Meeting\Expense;

use App\Models\Person;

class ShareExpensePriceAction {
    public function execute($request)
    {
        $share = $request->price / count($request->people);

        foreach ($request->people as $person) {
            $user = Person::find($person);
            $user->update(['balance' => $user->balance + $share]);
        }
    }
}
