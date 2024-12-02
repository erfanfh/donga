<?php

namespace App\Actions\Meeting;

use App\Http\Requests\StoreMeetingRequest;
use App\Models\Meeting;


class StoreNewMeetingAction
{

    /**
     * Save newly created meeting in database
     *
     * @param \App\Http\Requests\StoreMeetingRequest $request
     * @param array $people
     *
     * @return \App\Models\Meeting
     */
    public function execute(StoreMeetingRequest $request, array $people): Meeting
    {
        $meeting = auth()->user()->meetings()->create([
            'title' => $request->title,
            'budget' => $request->budget,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        foreach ($people as $person) {
            $meeting->persons()->create([
                'name' => $person,
            ]);
        }

        return $meeting;
    }
}
