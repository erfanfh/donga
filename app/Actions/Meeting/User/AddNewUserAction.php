<?php

namespace App\Actions\Meeting\User;

use App\Models\Meeting;
use Illuminate\Http\Request;

class AddNewUserAction {
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Meeting $meeting
     *
     * @return void
     */
    public function execute(Request $request, Meeting $meeting): void
    {
        $meeting->persons()->create([
            'name' => $request->name,
        ]);
    }
}
