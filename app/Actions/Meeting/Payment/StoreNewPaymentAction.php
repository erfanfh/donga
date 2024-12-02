<?php

namespace App\Actions\Meeting\Payment;

use App\Models\Person;

class StoreNewPaymentAction
{
    public function execute($request, Person $person): void
    {
        $person->payments()->create([
            'amount' => $request->amount,
            'creditor_id' => $request->creditor,
        ]);
    }
}
