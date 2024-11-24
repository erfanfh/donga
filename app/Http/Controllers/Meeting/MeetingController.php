<?php

namespace App\Http\Controllers\Meeting;

use App\Actions\Meeting\StoreNewMeetingAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMeetingRequest;

class MeetingController extends Controller
{
    /**
     * Store newly created meeting in database
     *
     * @param \App\Http\Requests\StoreMeetingRequest $request
     *
     * @return void
     */
    public function store(StoreMeetingRequest $request, StoreNewMeetingAction $storeNewMeeting)
    {
        $people = json_decode(str_replace('×', '', $request->people));
        $arr = '';

        foreach ($people as $person) {
            $arr .= $person . '/';
        }

        $storeNewMeeting->execute($request, $arr);
    }
}
