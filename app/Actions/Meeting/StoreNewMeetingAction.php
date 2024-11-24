<?php

namespace App\Actions\Meeting;

use App\Http\Requests\StoreMeetingRequest;


class StoreNewMeetingAction {

    /**
     * Save newly created meeting in database
     * @param \App\Http\Requests\StoreMeetingRequest $request
     *
     * @return void
     */
    public function execute(StoreMeetingRequest $request, string $arr): void
    {
        auth()->user()->meetings()->create([
            'title' => $request->title,
            'budget' => $request->budget,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'people' => $arr
        ]);
    }
}
