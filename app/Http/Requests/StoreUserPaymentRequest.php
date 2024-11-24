<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPaymentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:0',
        ];
    }

    /**
     * Set validation error messages
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'مبلغ را وارد کنید',
            'amount.numeric' => 'مبلغ را صحیح وارد کنید',
            'amount.min' => 'مبلغ را مثبت وارد کنید',
        ];
    }
}
