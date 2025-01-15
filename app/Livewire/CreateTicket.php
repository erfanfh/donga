<?php

namespace App\Livewire;

use App\Actions\Support\CreateTicketAction;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class CreateTicket extends Component
{
    #[Validate('required', message: 'عنوان تیکت را وارد کنید.')]
    #[Validate('max:255', message: 'عنوان باید کمتر از 255 حرف باشد.')]
    public $name;

    #[Validate('required', message: 'نوع تیکت را وارد کنید.')]
    public $category;

    #[Validate('required', message: 'بخش مربوطه تیکت را وارد کنید.')]
    public $section;

    #[Validate('required', message: 'توضیحات تیکت را وارد کنید.')]
    public $description;

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createTicket(): Redirector
    {
        $validated = $this->validate();

        $createTicket = new CreateTicketAction;
        $createTicket->execute($validated);

        return redirect()->route('support.index')->with('notification-success', 'تیکت شما با موفقیت ثبت شد.');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function render() : View
    {
        return view('livewire.create-ticket');
    }
}
