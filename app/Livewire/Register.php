<?php

namespace App\Livewire;

use App\Actions\User\CreateUserAction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Validate(['required', 'min:5', 'max:255'], message: [
        'required' => 'نام خود را وارد کنید.',
        'min' => 'نام باید بیشتر از 5 حرف باشد.',
        'max' => 'نام باید کمتر از 255 حرف باشد.'
    ])]
    public $firstName;
    #[Validate(['required', 'min:5', 'max:255'], message: [
        'required' => 'نام خانوادگی خود را وارد کنید.',
        'min' => 'نام خانوادگی باید بیشتر از 5 حرف باشد.',
        'max' => 'نام خانوادگی باید کمتر از 255 حرف باشد.'
    ])]
    public $lastName;

    #[Validate(['required', 'email', 'unique:users'], message: [
        'required' => 'ایمیل خود را وارد کنید.',
        'email' => 'ایمیل معتبر وارد کنید.',
        'unique' => 'ایمیل استفاده شده است.'
    ])]
    public $email;

    #[Validate(['required', 'confirmed', 'min:5', 'max:255'], message: [
        'required' => 'رمز عبور خود را وارد کنید.',
        'confirmed' => 'رمز عبور و تکرار رمز عبور تطابق ندارند.',
        'min' => 'رمز عبور باید بیشتر از 5 حرف باشد.',
        'max' => 'رمز عبور باید کمتر از 255 حرف باشد.'
    ])]
    public $password;
    #[Validate('required', message: 'تکرار رمز عبور خود را وارد کنید.')]
    public $password_confirmation;


    public function updatedPasswordConfirmation(): void
    {
        $this->validateOnly('password');
    }
    public function register(CreateUserAction $createUser): void
    {
        $validated = $this->validate();

        $user = $createUser->execute($validated);

        Auth::login($user);
    }
    public function render(): View
    {
        return view('livewire.register');
    }
}
