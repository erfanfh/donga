@extends('dashboard.master')
@section('title', 'ایجاد دورهمی جدید')

@section('content')
    <div class="text-3xl font-bold">ایجاد دورهمی جدید</div>

    <form class="mt-9" method="POST" action="{{ route('meetings.store') }}">
        @csrf
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="first_name"
                       class="block mb-2 text-sm font-medium dark:text-white {{ $errors->has('name') ? 'text-red-700' : 'text-gray-900' }}">
                    نام دورهمی</label>
                @if($errors->has('name'))
                    <input type="text" id="first_name" name="name" value="{{ old('name') }}"
                           class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus-visible:ring-red-500 focus-visible:border-red-500 focus-visible:outline-none focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                           placeholder="سفر چالوس"/>
                @else
                    <input type="text" id="first_name" name="name" value="{{ old('name') }}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="سفر چالوس"/>
                @endif
            </div>

            <div>
                <label for="last_name"
                       class="block mb-2 text-sm font-medium dark:text-white {{ $errors->has('budget') ? 'text-red-700' : 'text-gray-900' }}">
                    بودجه (اختیاری)</label>
                @if($errors->has('budget'))
                    <input type="text" id="last_name" name="budget" value="{{ old('budget') }}"
                           class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus-visible:ring-red-500 focus-visible:border-red-500 focus-visible:outline-none focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                           placeholder="3,500,000"/>
                @else
                    <input type="text" id="last_name" name="budget" value="{{ old('budget') }}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="3,500,000"/>
                @endif
            </div>

            <div>
                <label for="start-datepicker"
                       class="block mb-2 text-sm font-medium dark:text-white {{ $errors->has('start_date') ? 'text-red-700' : 'text-gray-900' }}">
                    تاریخ شروع</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    @if($errors->has('start_date'))
                        <input datepicker id="start-datepicker" type="text" name="start_date"
                               value="{{ old('start_date') }}"
                               class="bg-red-50 border border-red-300 text-red-900 text-sm placeholder-red-700 rounded-lg focus:ring-red-500 focus:border-red-500 block w-full ps-10 p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                               placeholder="تاریخ را وارد کیند">
                    @else
                        <input datepicker id="start-datepicker" type="text" name="start_date"
                               value="{{ old('start_date') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="تاریخ را وارد کیند">
                    @endif
                </div>
            </div>

            <div>
                <label for="end-datepicker"
                       class="block mb-2 text-sm font-medium dark:text-white {{ $errors->has('end_date') ? 'text-red-700' : 'text-gray-900' }}">
                    تاریخ پایان (اختیاری)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    @if($errors->has('end_date'))
                        <input datepicker id="end-datepicker" type="text" name="end_date"
                               value="{{ old('end_date') }}"
                               class="bg-red-50 border border-red-300 text-red-900 text-sm placeholder-red-700 rounded-lg focus:ring-red-500 focus:border-red-500 block w-full ps-10 p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                               placeholder="تاریخ را وارد کیند">
                    @else
                        <input datepicker id="end-datepicker" type="text" name="end_date"
                               value="{{ old('end_date') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="تاریخ را وارد کیند">
                    @endif
                </div>
            </div>

        </div>
        <label for="tag-container" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            افراد شرکت کننده</label>
        <div id="tag-container"
             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <input id="tag-input" type="text" name="people"
                   class="outline-none border-none flex-grow p-1 bg-transparent"
                   placeholder="تایپ کنید و با tab جدا کنید">
        </div>

        <button type="submit" id="submit"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 mt-3">
            ایجاد
        </button>
    </form>
    @if($errors->any())
        <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 mt-6"
             role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">خطا</span>
            <div>
                <span class="font-medium">خطاهای زیر را اصلاح کنید:</span>
                <ul class="mt-1.5 list-disc list-inside">
                    @error('name')
                    <li> {{ $message }} </li> @enderror
                    @error('budget')
                    <li> {{ $message }} </li> @enderror
                    @error('start_date')
                    <li> {{ $message }} </li> @enderror
                    @error('end_date')
                    <li> {{ $message }} </li> @enderror
                    @error('people')
                    <li> {{ $message }} </li> @enderror
                </ul>
            </div>
        </div>
    @endif

    <script src="{{ asset('js/new-meeting-people.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
@endsection
