<?php

namespace App\Livewire;

use App\Actions\Auth\CreateVerificationCodeAction;
use App\Actions\Auth\SendVerificationMailAction;
use App\Actions\User\CreateUserAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Validate('required', message: 'نام خود را وارد کنید.')]
    #[Validate('min:3', message: 'نام باید  بیشتر از 5 حرف باشد.')]
    #[Validate('max:255', message: 'نام باید کمتر از 255 حرف باشد.')]
    public $firstName;

    #[Validate('required', message: 'نام خانوادگی خود را وارد کنید.')]
    #[Validate('min:3', message: 'نام خانوادگی باید  بیشتر از 5 حرف باشد.')]
    #[Validate('max:255', message: 'نام خانوادگی باید کمتر از 255 حرف باشد.')]
    public $lastName;

    #[Validate('required', message: 'ایمیل خود را وارد کنید.')]
    #[Validate('email', message: 'ایمیل معتبر وارد کنید.')]
    #[Validate('unique:users', message: 'ایمیل استفاده شده است.')]
    public $email;

    #[Validate('required', message: 'رمز عبور خود را وارد کنید.')]
    #[Validate('confirmed', message: 'رمز و عبور و تکرار رمزعبور تطابق ندارند.')]
    #[Validate('min:5', message: 'رمز عبور باید  بیشتر از 5 حرف باشد.')]
    #[Validate('max:255', message: 'رمز عبور باید کمتر از 255 حرف باشد')]
    public $password;

    #[Validate('required', message: 'تکرار رمز عبور خود را وارد کنید.')]
    public $password_confirmation;


    /**
     * Update password field after password_confirmation is updated
     *
     * @return void
     */
    public function updatedPasswordConfirmation(): void
    {
        $this->validateOnly('password');
    }


    /**
     * Validate inputs and create user model
     *
     * @param \App\Actions\User\CreateUserAction $createUser
     * @param \App\Actions\Auth\SendVerificationMailAction $sendVerificationMail
     * @param \App\Actions\Auth\CreateVerificationCodeAction $createVerificationCode
     *
     * @return null
     */
    public function register(CreateUserAction $createUser, SendVerificationMailAction $sendVerificationMail, CreateVerificationCodeAction $createVerificationCode): null
    {
        $validated = $this->validate();

        $user = $createUser->execute($validated);

        Auth::login($user);

        $code = $createVerificationCode->execute();

        $sendVerificationMail->execute($this->email, $code);

        return $this->redirect(route('verify'));
    }

    /**
     * Return the livewire view
     *
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        return view('livewire.register');
    }
}
