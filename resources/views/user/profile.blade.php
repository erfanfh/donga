@extends('dashboard.master')
@section('title', 'حساب کاربری')

@section('content')
    <div class="text-3xl font-bold">اطلاعات کاربری</div>

    <form class="mt-9" method="POST" action="{{ route('user.edit') }}">
        @csrf
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="first_name"
                       class="block mb-2 text-sm font-medium dark:text-white {{ $errors->has('firstname') ? 'text-red-700' : 'text-gray-900' }}">
                    نام</label>
                @if($errors->has('firstname'))
                    <input type="text" id="first_name" name="firstname" value="{{ auth()->user()->firstName }}"
                           class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus-visible:ring-red-500 focus-visible:border-red-500 focus-visible:outline-none focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                           placeholder="امیر"/>
                @else
                    <input type="text" id="first_name" name="firstname" value="{{ auth()->user()->firstName }}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="امیر"/>
                @endif
            </div>

            <div>
                <label for="last_name"
                       class="block mb-2 text-sm font-medium dark:text-white {{ $errors->has('lastname') ? 'text-red-700' : 'text-gray-900' }}">
                    نام خانوادگی</label>
                @if($errors->has('lastname'))
                    <input type="text" id="last_name" name="lastname" value="{{ auth()->user()->lastName }}"
                           class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus-visible:ring-red-500 focus-visible:border-red-500 focus-visible:outline-none focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                           placeholder="کدخدا"/>
                @else
                    <input type="text" id="last_name" name="lastname" value="{{ auth()->user()->lastName }}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="کدخدا"/>
                @endif
            </div>

        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="email"
                       class="block mb-2 text-sm font-medium dark:text-white {{ $errors->has('email') ? 'text-red-700' : 'text-gray-900' }}">
                    ایمیل</label>
                @if($errors->has('email'))
                    <input type="text" id="email" name="email" value="{{ $email ?? auth()->user()->email }}" disabled
                           class="cursor-not-allowed bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus-visible:ring-red-500 focus-visible:border-red-500 focus-visible:outline-none focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                           placeholder="email@example.com"/>
                @else
                    <input type="text" id="email" name="email" value="{{ $email ?? auth()->user()->email }}" disabled
                           class="cursor-not-allowed bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="email@example.com"/>
                @endif
            </div>
            <div class="flex items-end justify-start">
                <a href="{{ route("user.change-password") }}"
                        class="text-center focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 w-1/4">
                    تغییر رمز عبور
                </a>
            </div>
        </div>

        <button type="submit" id="submit"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 mt-3">
            ذخیره
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
                    @error('firstname')
                    <li> {{ $message }} </li> @enderror
                    @error('lastname')
                    <li> {{ $message }} </li> @enderror
                    @error('email')
                    <li> {{ $message }} </li> @enderror
                </ul>
            </div>
        </div>
    @endif

    <script src="{{ asset('js/new-meeting-people.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
@endsection
