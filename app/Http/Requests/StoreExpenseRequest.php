<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreExpenseRequest extends FormRequest
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
            'price' => 'required|numeric|min:0',
            'people' => 'required',
            'description' => 'nullable|max:2000',
            'sponsor' => 'required',
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
          'name.required'  => 'لطفا عنوان خرج را وارد کنید.',
          'name.max'  => 'عنوان خرج نباید بیشتر از 255 حرف باشد.',
          'price.required'  => 'لطفا مبلغ خرج را وارد کنید.',
          'price.numeric'  => 'مقدار خرج باید عددی باشد.',
          'price.min'  => 'مقدار خرج باید عددی مثبت باشد.',
          'people.required'  => 'افراد دخیل در خرج را وارد کنید.',
          'description.max'  => 'توضیحات نباید بیشتر از 2000 حرف باشد.',
          'sponsor.required'  => 'لطفا فرد خرج کننده را وارد کنید.',
        ];
    }
}
