<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'firstname.required' => 'نام خود را وارد کنید',
            'firstname.string' => 'نام خود را به طور صحیح وارد کنید',
            'firstname.max' => 'نام میتواند حداکثر 255 کاراکتر باشد',
            'lastname.required' => 'نام خانوادگی خود را وارد کنید',
            'lastname.string' => 'نام خانوادگی خود را به طور صحیح وارد کنید',
            'lastname.max' => 'نام خانوادگی میتواند حداکثر 255 کاراکتر باشد',
        ];
    }
}
