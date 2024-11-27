<?php

namespace App\Actions\Meeting\Expense;

use App\Models\Expense;
use App\Models\Meeting;

class StoreNewExpenseAction {
    public function execute($request, Meeting $meeting)
    {
        $expense = $meeting->expenses()->create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description ?? ' ',
        ]);

        foreach ($request->people as $person) {
            $expense->persons()->attach($person);
        }
    }
}
