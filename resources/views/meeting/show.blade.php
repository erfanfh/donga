@extends('dashboard.master')

@section('title', $meeting->title)

@section('content')
    <link rel="stylesheet" href="{{ asset('css/MultiSelect.css') }}">
    <section class="flex flex-col">
        <div class="flex items-center gap-2">
            <div class="text-3xl font-bold" id="meeting-title">
                {{ $meeting->title }}
            </div>
            <form action="{{ route('meetings.update.name', $meeting->id) }}" method="post" class="hidden flex"
                  id="meeting-title-form">
                @csrf
                <input name="title"
                       class="text-3xl font-bold border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       type="text" value="{{ $meeting->title }}">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="green" class="bi bi-check2"
                         viewBox="0 0 16 16">
                        <path
                            d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                    </svg>
                </button>
                <button type="button" onclick="closeForm()" class="hidden" id="close-form-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="red" class="bi bi-x"
                         viewBox="0 0 16 16">
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                </button>
            </form>
            <button type="button" onclick="changeTitle()" id="change-meeting-title-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-pencil-fill"
                     viewBox="0 0 16 16">
                    <path
                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                </svg>
            </button>
        </div>
        @error('title')
        <div class="p-4 my-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">خطا!</span> {{ $message }}
        </div>
        @enderror
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
            <div
                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    خرج {{ $meeting->title }}</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">{{ number_format($meeting->expenses()->sum('price')) }}
                    تومان</p>
            </div>

            <div
                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">تعداد افراد</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">{{ $meeting->persons()->count() }} نفر</p>
            </div>

            <div
                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    طول {{ $meeting->title }}</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">{{ ceil($meeting->created_at->diffInDays(now())) }}
                    روز </p>
            </div>

            <button type="button"
                    class="flex flex-col items-center justify-evenly max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                    aria-label="Add new record"
                    data-modal-target="create-expense-modal" data-modal-toggle="create-expense-modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-lg"
                     viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                </svg>
                <span class="text-sm font-medium">ایجاد خرج جدید</span>
            </button>
        </div>

        <!-- New Expense Modal -->
        <div id="create-expense-modal" tabindex="-1" aria-hidden="true"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            ایجاد خرج جدید
                        </h3>
                        <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="create-expense-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5 flex flex-col" action="{{ route('meetings.expense.store', $meeting) }}"
                          id="expenseForm"
                          method="POST">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">بابت</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="غذای ناهار رستوران">
                                @error('name')
                                <div class="text-red-500">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-span-2">
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">مبلغ</label>
                                <input type="text" name="price" id="price" value="{{ old('price') }}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="2,500,000 تومان">
                                @error('price')
                                <div class="text-red-500">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-span-2">
                                <label for="category"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">برای
                                    افراد</label>
                                <select id="user-multi-select" data-placeholder="افراد هدف" multiple="multiple"
                                        name="people">
                                    @foreach($meeting->persons as $creditor)
                                        <option name="user{{$creditor->name}}"
                                                value="{{$creditor->id}}">{{ $creditor->name }}</option>
                                    @endforeach
                                </select>
                                @error('people')
                                <div class="text-red-500">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-span-2">
                                <label for="sponsor"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">خرج
                                    کننده</label>
                                <select id="sponsor" dir="rtl" name="sponsor"
                                        class="bg-gray-50 border pe-5 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach($meeting->persons as $creditor)
                                        <option name="user{{$creditor->name}}"
                                                value="{{$creditor->id}}">{{ $creditor->name }}</option>
                                    @endforeach
                                </select>
                                @error('people')
                                <div class="text-red-500">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-span-2">
                                <label for="description"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">توضیحات</label>
                                <textarea id="description" rows="4" name="description" value="{{ old('description') }}"
                                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                          placeholder="توضیحات این خرج را در صورت نیاز وارد کنید..."></textarea>
                                @error('description')
                                <div class="text-red-500">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit"
                                class="flex gap-2 w-1/4 self-end text-white items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <p>ایجاد</p>
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- New User Modal -->
        <div id="add-user-modal" tabindex="-1" aria-hidden="true"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            اضافه کردن فرد جدید
                        </h3>
                        <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="add-user-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5 flex flex-col" action="{{ route('meetings.add.user', $meeting) }}"
                          method="POST">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="user-name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نام</label>
                                <input type="text" name="name" id="user-name" value="{{ old('name') }}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="امیرحسین کدخدا">
                                @error('name')
                                <div class="text-red-500">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit"
                                class="w-1/4 self-end text-white items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <p>افزودن</p>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex flex-col mt-6">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border rounded-lg overflow-hidden dark:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                    نام
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                    تاریخ عضویت
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                    تراز مالی
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                    وضعیت
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                    عملیات
                                </th>

                                <th scope="col"
                                    class="flex justify-end px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">

                                    <button type="button"
                                            class="flex items-center gap-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                            data-modal-target="add-user-modal" data-modal-toggle="add-user-modal">
                                        افزودن
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                            <path
                                                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                            <path
                                                d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                                        </svg>
                                    </button>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @foreach($meeting->persons as $person)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $person->name }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        {{ \Morilog\Jalali\Jalalian::fromCarbon($person->created_at)->format('Y/m/d') }}
                                    </td>

                                    @php
                                        $textColor = match($person->status) {
                                            'creditor' => 'text-green-600',
                                            'debtor' => 'text-red-600',
                                            default => 'text-gray-800',
                                        };
                                    @endphp

                                    <td class="px-6 py-4 whitespace-nowrap text-sm {{ $textColor }} dark:text-neutral-200">
                                        {{ number_format($person->balance) }} تومان
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        @if($person->status == 'creditor')
                                            طلبکار
                                        @elseif($person->status == 'debtor')
                                            بدهکار
                                        @else
                                            تسویه
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <button type="button" data-modal-target="popup-modal-{{$person->id}}"
                                                data-modal-toggle="popup-modal-{{$person->id}}"
                                                class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">
                                            پرداخت
                                        </button>
                                    </td>

                                    <div id="popup-modal-{{$person->id}}" tabindex="-1"
                                         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <button type="button"
                                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="popup-modal-{{ $person->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                         xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                              stroke-linejoin="round" stroke-width="2"
                                                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-4 md:p-5 text-center">
                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                         aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                         fill="none"
                                                         viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                              stroke-linejoin="round" stroke-width="2"
                                                              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                        مقدار پرداختی {{$person->name}} را وارد کنید</h3>
                                                    <form class="p-4 md:p-5 flex flex-col paymentForm"
                                                          action="{{ route('meetings.pay.user', $person) }}"
                                                          method="POST">
                                                        @csrf
                                                        <div class="grid gap-4 mb-4 grid-cols-2">
                                                            <div class="col-span-2 flex flex-col items-start">
                                                                <label for="amount-{{ $person->id }}"
                                                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">مبلغ</label>
                                                                <input type="text" name="amount" id="amount-{{ $person->id }}"
                                                                       value="{{ old('price') }}"
                                                                       class="amount bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                       placeholder="1,000,000 تومان">
                                                                @error('amount')
                                                                <div class="text-red-500">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-span-2 flex flex-col items-start">
                                                                <label for="creditor"
                                                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">پرداخت
                                                                    به</label>
                                                                <select id="creditor" dir="rtl" name="creditor"
                                                                        class="bg-gray-50 border pe-5 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                    @foreach($meeting->getCreditorsAttribute($meeting) as $creditor)
                                                                        <option name="user{{$creditor->name}}"
                                                                                value="{{$creditor->id}}">{{ $creditor->name . " ( طلب " . number_format($creditor->balance) . " تومان)" }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('creditor')
                                                                <div class="text-red-500">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <button type="submit"
                                                                class="flex gap-2 w-1/4 self-end text-white items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                            <p>ایجاد</p>
                                                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor"
                                                                 viewBox="0 0 20 20"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                      d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                                      clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/MultiSelect.js') }}"></script>
    <script>
        function changeTitle() {
            const old_meeting = document.getElementById('meeting-title');
            const new_meeting = document.getElementById('meeting-title-form');
            const change_meeting_title_button = document.getElementById('change-meeting-title-button');
            const close_form_button = document.getElementById('close-form-button');

            old_meeting.classList.add('hidden');
            change_meeting_title_button.classList.add('hidden');
            new_meeting.classList.remove('hidden');
            close_form_button.classList.remove('hidden');
        }

        function closeForm() {
            const old_meeting = document.getElementById('meeting-title');
            const new_meeting = document.getElementById('meeting-title-form');
            const change_meeting_title_button = document.getElementById('change-meeting-title-button');
            const close_form_button = document.getElementById('close-form-button');

            old_meeting.classList.remove('hidden');
            change_meeting_title_button.classList.remove('hidden');
            new_meeting.classList.add('hidden');
            close_form_button.classList.add('hidden');
        }
    </script>
    <script>
        new MultiSelect(document.getElementById('user-multi-select'));
    </script>
    <script>
        // Format the price input
        document.getElementById('price').addEventListener('input', function (e) {
            let input = e.target.value.replace(/\D/g, '');
            input = input.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            e.target.value = input;
        });
    </script>
    <script>
        // Set the price inout unformat
        document.getElementById('expenseForm').addEventListener('submit', function (e) {
            let inputField = document.getElementById('price');
            inputField.value = inputField.value.replace(/,/g, '');
        });
    </script>

@endsection
