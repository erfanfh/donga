<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeetingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:255',
            'budget' => 'nullable|sometimes|numeric|min:0',
            'start_time' => 'required|date',
            'end_time' => 'nullable|sometimes|date',
            'people' => 'required',
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
            'title.required' => 'نام دورهمی را وارد کنید',
            'title.min' => 'نام دورهمی باید بیشتر از 3 حرف باشد',
            'title.max' => 'نام دورهمی باید کمتر از 255 حرف باشد',
            'budget.sometimes' => 'بودجه را وارد کنید',
            'budget.numeric' => 'بودجه باید فقط شامل عدد باشد',
            'budget.min' => 'بودجه نمیتواند کمتر از صفر باشد',
            'start_time.required' => 'تاریخ شروع را وارد کنید',
            'start_time.date' => 'فرمت تاریخ شروع اشتباه است',
            'end_time.sometimes' => 'تاریخ پایان را وارد کنید',
            'end_time.date' => 'فرمت تاریخ پایان اشتباه است',
            'people.required' => 'افراد شرکت کننده را وارد کنید',
        ];
    }
}
