<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * Set the message for errors in validation
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'email.required' => 'ایمیل خود را وارد کنید.',
            'password.required' => 'رمز عبور خود را وارد کنید.',
        ];
    }
}
