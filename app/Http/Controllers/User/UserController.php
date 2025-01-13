<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit(EditUserRequest $request,)
    {
        Auth::user()->update([
            'firstName' => $request->firstname,
            'lastName' => $request->lastname,
        ]);

        return redirect()->back()->with('notification-success', 'اطلاعات شما با موفقیت تغییر کرد');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if (!Hash::check($request->password, Auth::user()->password)) {
            return redirect()->back()->with('notification-error', 'رمز عبور فعلی را اشتباه وارد کردید.');
        }

        Auth::user()->update([
            'password' => $request->new_password,
        ]);

        return redirect()->back()->with('notification-success', 'رمز عبور شما با موفقیت تغییر یاقت.');
    }
}
