<?php

namespace App\Actions\Meeting\Expense;

use App\Models\Meeting;
use App\Models\Person;

class StoreNewExpenseAction {
    /**
     * @param $request
     * @param \App\Models\Meeting $meeting
     *
     * @return void
     */
    public function execute($request, Meeting $meeting): void
    {
        $expense = $meeting->expenses()->create([
            'name' => $request->name,
            'price' => $request->price,
            'person_id' => $request->sponsor,
            'description' => $request->description ?? ' ',
        ]);

        foreach ($request->people as $person) {
            $expense->persons()->attach($person);
        }
    }
}
