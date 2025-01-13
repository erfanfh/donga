<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'required',
            'new_password' => 'required|min:8|max:255',
            'new_password_confirmation' => 'required|same:new_password',
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'رمزعبور فعلی خود را وارد کنید.',
            'new_password.required' => 'رمزعبور جدید خود را وارد کنید.',
            'new_password.min' => 'رمزعبور جدید باید حداقل 8 کاراکتر باشد.',
            'new_password.max' => 'رمزعبور جدید باید حداکـثر 255 کاراکتر باشد.',
            'new_password_confirmation.required' => 'تکرار رمزعبور جدید خود را وارد کنید.',
            'new_password_confirmation.same' => 'تکرار رمزعبور جدید با رمز عبور جدید تطابق ندارد.',
        ];
    }
}
