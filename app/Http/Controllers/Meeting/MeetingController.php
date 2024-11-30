<?php

namespace App\Http\Controllers\Meeting;

use App\Actions\Meeting\Expense\ShareExpensePriceAction;
use App\Actions\Meeting\Expense\StoreNewExpenseAction;
use App\Actions\Meeting\StoreNewMeetingAction;
use App\Actions\Meeting\UpdateMeetingNameAction;
use App\Actions\Meeting\User\AddNewUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddNewUserForAMeetingRequest;
use App\Http\Requests\StoreExpenseAction;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\StoreUserPaymentRequest;
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
        $people = json_decode(str_replace('×', '', $request->participants));

        $storeNewMeeting->execute($request, $people);
    }

    /**
     * Show each meeting's page
     *
     * @param \App\Models\Meeting $meeting
     *
     * @return \Illuminate\View\View
     */
    public function show(Meeting $meeting): View
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
    public function updateName(Request $request, Meeting $meeting, UpdateMeetingNameAction $updateMeetingName): RedirectResponse
    {
        $request->validate(
            ['title' => 'required'],
            ['title.required' => 'نام دورهمی را وارد کنید.']
        );

        $updateMeetingName->execute($meeting, $request->title);

        return redirect()->route('meetings.show', compact('meeting'));
    }

    public function userPay(StoreUserPaymentRequest $request)
    {
        //
    }

    /**
     * Create a new expense for an existing meeting
     *
     * @param \App\Http\Requests\StoreExpenseRequest $request
     * @param \App\Models\Meeting $meeting
     * @param \App\Actions\Meeting\Expense\StoreNewExpenseAction $storeNewExpense
     * @param \App\Actions\Meeting\Expense\ShareExpensePriceAction $shareExpensePrice
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeExpense(StoreExpenseRequest $request, Meeting $meeting, StoreNewExpenseAction $storeNewExpense, ShareExpensePriceAction $shareExpensePrice)
    {
        $storeNewExpense->execute($request, $meeting);

        $shareExpensePrice->execute($request);

        return redirect()->route('meetings.show', compact('meeting'));
    }

    public function addUser(AddNewUserForAMeetingRequest $request, Meeting $meeting, AddNewUserAction $addNewUser)
    {
        $addNewUser->execute($request, $meeting);

        return redirect()->back();
    }
}
