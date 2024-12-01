<?php

namespace App\Http\Controllers\Meeting;

use App\Actions\Meeting\Expense\ShareExpensePriceAction;
use App\Actions\Meeting\Expense\StoreNewExpenseAction;
use App\Actions\Meeting\Payment\StoreNewPaymentAction;
use App\Actions\Meeting\StoreNewMeetingAction;
use App\Actions\Meeting\UpdateMeetingNameAction;
use App\Actions\Meeting\User\AddNewUserAction;
use App\Actions\User\UpdateUserBalanceAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddNewUserForAMeetingRequest;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\StoreUserPaymentRequest;
use App\Models\Meeting;
use App\Models\Person;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
    public function store(StoreMeetingRequest $request)
    {
        $people = json_decode(str_replace('×', '', $request->participants));

        StoreNewMeetingAction::execute($request, $people);
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
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateName(Request $request, Meeting $meeting): RedirectResponse
    {
        $updateMeetingName = new UpdateMeetingNameAction;

        $request->validate(
            ['title' => 'required'],
            ['title.required' => 'نام دورهمی را وارد کنید.']
        );

        $updateMeetingName->execute($meeting, $request->title);

        return redirect()->route('meetings.show', compact('meeting'));
    }

    /**
     * @param \App\Http\Requests\StoreUserPaymentRequest $request
     * @param \App\Models\Person $person
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userPay(StoreUserPaymentRequest $request, Person $person): RedirectResponse
    {
        if (! Gate::allows('make-self-payment', [$person, $request])) {
            return redirect()->back()->with('notification-error', 'نمی توانید به خودتان پرداخت داشته باشید.');
        }

        if (! Gate::allows('make-payment', $person )) {
            return redirect()->back()->with('notification-error', 'نمی توانید بدون داشتن بدهی پرداخت داشته باشید.');
        }

        $storeNewPayment = new StoreNewPaymentAction;
        $updateUserBalance = new UpdateUserBalanceAction;

        $creditor = Person::find($request->creditor);

        $storeNewPayment->execute($request, $person);
        $updateUserBalance->execute($person, $request->amount);
        $updateUserBalance->execute($creditor, -$request->amount);

        return redirect()->back();
    }

    /**
     * Create a new expense for an existing meeting
     *
     * @param \App\Http\Requests\StoreExpenseRequest $request
     * @param \App\Models\Meeting $meeting
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeExpense(StoreExpenseRequest $request, Meeting $meeting)
    {
        $storeNewExpense = new StoreNewExpenseAction;
        $shareExpensePrice = new ShareExpensePriceAction;

        $storeNewExpense->execute($request, $meeting);
        $shareExpensePrice->execute($request);

        return redirect()->route('meetings.show', compact('meeting'));
    }

    /**
     * @param \App\Http\Requests\AddNewUserForAMeetingRequest $request
     * @param \App\Models\Meeting $meeting
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addUser(AddNewUserForAMeetingRequest $request, Meeting $meeting): RedirectResponse
    {
        $addNewUserAction = new AddNewUserAction;

        $addNewUserAction->execute($request, $meeting);

        return redirect()->back();
    }
}
