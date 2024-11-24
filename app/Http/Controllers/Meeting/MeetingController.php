<?php

namespace App\Http\Controllers\Meeting;

use App\Actions\Meeting\StoreNewMeetingAction;
use App\Actions\Meeting\UpdateMeetingNameAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMeetingRequest;
use App\Models\Meeting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


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
        $arr = implode(',', $people);

        $storeNewMeeting->execute($request, $arr);
    }

    /**
     * Show each meeting's page
     *
     * @param \App\Models\Meeting $meeting
     *
     * @return \Illuminate\View\View
     */
    public function show(Meeting $meeting) : View
    {
        return view('meeting.show', compact('meeting'));
    }

    /**
     * Update a created meeting's name
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Meeting $meeting
     * @param \App\Actions\Meeting\UpdateMeetingNameAction $updateMeetingName
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateName(Request $request, Meeting $meeting , UpdateMeetingNameAction $updateMeetingName) : RedirectResponse
    {
        $request->validate(
            ['title' => 'required'],
            ['title.required' => 'نام دورهمی را وارد کنید.']
        );

        $updateMeetingName->execute($meeting, $request->title);

        return redirect()->route('meetings.show', compact('meeting'));
    }
}
