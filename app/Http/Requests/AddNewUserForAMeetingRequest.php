<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewUserForAMeetingRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
        ];
    }

    /**
     * Set the validation errors messages
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'نام فرد را وارد کنید.',
            'name.max' => 'نام فرد باید کمتر از 255 حرف باشد.'
        ];
    }
}
