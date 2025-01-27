<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\CreateVerificationCodeAction;
use App\Actions\Auth\SendVerificationMailAction;
use App\Actions\Auth\ValidateLoginFormAction;
use App\Actions\User\ChangeUserEmailAction;
use App\Actions\User\LogoutUserAction;
use App\Actions\User\VerifyUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Call an action to login an unauthenticated user
     *
     * @param \App\Http\Requests\UserLoginRequest $request
     * @param \App\Actions\Auth\ValidateLoginFormAction $validateLoginForm
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(UserLoginRequest $request, ValidateLoginFormAction $validateLoginForm) : RedirectResponse
    {
        if ($validateLoginForm->execute($request)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return redirect()->back()->with(['error' => 'ایمیل یا رمز عبور اشتباه است.']);
    }

    /**
     * Call an action to log out an authenticated user
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Actions\User\LogoutUserAction $logoutUser
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function logout(Request $request, LogoutUserAction $logoutUser) : RedirectResponse
    {
        $logoutUser->execute($request);

        return redirect('/');
    }

    /**
     *
     * Show verification page
     * @param \App\Actions\Auth\CreateVerificationCodeAction $createVerificationCode
     * @param \App\Actions\Auth\SendVerificationMailAction $sendVerificationMail
     *
     * @return \Illuminate\View\View
     */
    public function verify(CreateVerificationCodeAction $createVerificationCode, SendVerificationMailAction $sendVerificationMail)
    {
        if (empty(auth()->user()->codes->all())) {
            $code = $createVerificationCode->execute();

            $sendVerificationMail->execute(auth()->user()->email, $code);
        }

        if (auth()->user()->codes->last()->expired_at < now())
        {
            $code = $createVerificationCode->execute();

            $sendVerificationMail->execute(auth()->user()->email, $code);
        }

        return view('verification.verify');
    }

    /**
     * Call a method to verify the user
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Actions\User\VerifyUserAction $verifyUser
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyPost(Request $request, VerifyUserAction $verifyUser) : RedirectResponse
    {
        $code = auth()->user()->codes->last();

        $code = str_split($code->code);

        if ($code[0] == $request->char1 && $code[1] == $request->char2 && $code[2] == $request->char3 && $code[3] == $request->char4)
        {
            $verifyUser->execute();

            return redirect('/');

        } else {
            return redirect()->route('verify')->with('error', 'کد تایید وارد شده معتبر نمی باشد');
        }
    }

    /**
     * Resend verification code
     * @param \App\Actions\Auth\CreateVerificationCodeAction $createVerificationCode
     * @param \App\Actions\Auth\SendVerificationMailAction $sendVerificationMail
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend(CreateVerificationCodeAction $createVerificationCode, SendVerificationMailAction $sendVerificationMail) : RedirectResponse
    {
        if (empty(auth()->user()->codes->all())) {
            $code = $createVerificationCode->execute();

            $sendVerificationMail->execute(auth()->user()->email, $code);

            return redirect()->route('verify');
        }

        if (auth()->user()->codes->last()->created_at->addMinutes(2) > now()) {
            $error = 'برای دریافت مجدد کد ' . round(120 - auth()->user()->codes->last()->created_at->diffInUTCSeconds(now())) . ' ثانیه دیگر صبر کنید';

            return redirect()->route('verify')->with('error', $error);
        }

        $code = $createVerificationCode->execute();

        $sendVerificationMail->execute(auth()->user()->email, $code);

        return redirect()->route('verify');
    }

    /**
     * show change the user's email for validation page
     * @param \App\Actions\Auth\CreateVerificationCodeAction $createVerificationCode
     * @param \App\Actions\Auth\SendVerificationMailAction $sendVerificationMail
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function changeEmail(CreateVerificationCodeAction $createVerificationCode, SendVerificationMailAction $sendVerificationMail) : View|RedirectResponse
    {
        if (empty(auth()->user()->codes->all())) {
            $code = $createVerificationCode->execute();

            $sendVerificationMail->execute(auth()->user()->email, $code);

            return redirect()->route('verify');
        }

        if (auth()->user()->codes->last()->created_at->addMinutes(2) > now()) {
            $error = 'برای تغییر ایمیل ' . round(120 - auth()->user()->codes->last()->created_at->diffInUTCSeconds(now())) . ' ثانیه دیگر صبر کنید';

            return redirect()->route('verify')->with('error', $error);
        }

        return view('verification.changeEmail');
    }

    /**
     * Validate the request for change the email
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Actions\Auth\SendVerificationMailAction $sendVerificationMail
     * @param \App\Actions\Auth\CreateVerificationCodeAction $createVerificationCode
     * @param \App\Actions\User\ChangeUserEmailAction $changeUserEmail
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeEmailPost(Request $request , SendVerificationMailAction $sendVerificationMail, CreateVerificationCodeAction $createVerificationCode, ChangeUserEmailAction $changeUserEmail) : RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ], [
            'email.required' => 'ایمیل خود را وارد کنید',
            'email.email' => 'ایمیل معتبر وارد کنید',
            'email.max:255' => 'ایمیل باید حداکثر 255 حرف باشد',
        ]);

        $changeUserEmail->execute($request);

        $code = $createVerificationCode->execute();

        $sendVerificationMail->execute(auth()->user()->email, $code);

        return redirect()->route('verify');

    }
}
