<?php

namespace App\Http\Controllers\Meeting;

use App\Actions\Meeting\Expense\ShareExpensePriceAction;
use App\Actions\Meeting\Expense\StoreNewExpenseAction;
use App\Actions\Meeting\Payment\StoreNewPaymentAction;
use App\Actions\Meeting\StoreNewMeetingAction;
use App\Actions\Meeting\UpdateMeetingNameAction;
use App\Actions\Meeting\User\AddNewUserAction;
use App\Actions\User\DestroyUserAction;
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreMeetingRequest $request) : RedirectResponse
    {
        $storeNewMeetingAction = new StoreNewMeetingAction;

        $people = json_decode(str_replace('×', '', $request->participants));

        $meeting =$storeNewMeetingAction->execute($request, $people);

        return redirect()->route('meetings.show', $meeting)->with('notification-success', 'دوره با موفقیت ایجاد شد.');
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

        return redirect()->route('meetings.show', compact('meeting'))->with('notification-success', 'نام دورهمی با موفقیت تغییر یافت.');
    }

    /**
     * @param \App\Http\Requests\StoreUserPaymentRequest $request
     * @param \App\Models\Person $person
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userPay(StoreUserPaymentRequest $request, Person $person): RedirectResponse
    {
        if (Gate::denies('make-self-payment', [$person, $request])) {
            return redirect()->back()->with('notification-error', 'نمی توانید به خودتان پرداخت داشته باشید.');
        }

        if (Gate::denies('make-payment', $person )) {
            return redirect()->back()->with('notification-error', 'نمی توانید بدون داشتن بدهی پرداخت داشته باشید.');
        }

        if (Gate::denies('make-too-payment', [$person, $request->amount] )) {
            return redirect()->back()->with('notification-error', 'نمی توانید بیشتر از بدهی خود پرداخت داشته باشید.');
        }

        $storeNewPayment = new StoreNewPaymentAction;
        $updateUserBalance = new UpdateUserBalanceAction;

        $creditor = Person::find($request->creditor);

        $storeNewPayment->execute($request, $person);
        $updateUserBalance->execute($person, $request->amount);
        $updateUserBalance->execute($creditor, -$request->amount);

        return redirect()->back()->with('notification-success', 'پرداخت با موفقیت انجام شد.');
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

        return redirect()->route('meetings.show', compact('meeting'))->with('notification-success', 'خرج جدید با موفقیت ایجاد شد.');
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

        return redirect()->back()->with('notification-success', 'کاربر با موفقیت ایجاد شد.');
    }

    /**
     * @param \App\Models\Person $person
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser(Person $person): RedirectResponse
    {
        if (! Gate::allows('delete-person', [$person])) {
            return redirect()->back()->with('notification-error', 'برای حذف کاربری باید ابتدا وضعیت او را به تسویه تغییر دهید.');
        }

        $destroyUser = new DestroyUserAction;

        $destroyUser->execute($person);

        return redirect()->back()->with('notification-success', 'کاربر با موفقیت حذف شد.');
    }
}
