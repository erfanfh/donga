@extends('dashboard.master')
@section('title', 'حساب کاربری')

@section('content')
    <div class="text-3xl font-bold">اطلاعات کاربری</div>

    <form class="mt-9" method="POST" action="{{ route('user.change-password-post') }}">
        @csrf
        <div class="grid gap-6 mb-6 md:grid-cols-1">
            <div>
                <label for="password"
                       class="block mb-2 text-sm font-medium dark:text-white {{ $errors->has('password') ? 'text-red-700' : 'text-gray-900' }}">
                    رمز عبور فعلی</label>
                @if($errors->has('password'))
                    <input type="password" id="password" name="password"
                           class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus-visible:ring-red-500 focus-visible:border-red-500 focus-visible:outline-none focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                           />
                @else
                    <input type="password" id="password" name="password"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           />
                @endif
            </div>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-1">
            <div>
                <label for="new_password"
                       class="block mb-2 text-sm font-medium dark:text-white {{ $errors->has('new_password') ? 'text-red-700' : 'text-gray-900' }}">
                    رمز عبور جدید</label>
                @if($errors->has('new_password'))
                    <input type="password" id="new_password" name="new_password"
                           class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus-visible:ring-red-500 focus-visible:border-red-500 focus-visible:outline-none focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                           />
                @else
                    <input type="password" id="new_password" name="new_password"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           />
                @endif
            </div>
        </div>


        <div class="grid gap-6 mb-6 md:grid-cols-1">
            <div>
                <label for="email"
                       class="block mb-2 text-sm font-medium dark:text-white {{ $errors->has('new_password_confirmation') ? 'text-red-700' : 'text-gray-900' }}">
                    تکرار رمزعبور جدید</label>
                @if($errors->has('new_password_confirmation'))
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                           class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus-visible:ring-red-500 focus-visible:border-red-500 focus-visible:outline-none focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                    />
                @else
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    />
                @endif
            </div>
        </div>

        <button type="submit" id="submit"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 mt-3">
            ذخیره
        </button>

        <a href="{{ route('user.profile') }}"
                class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 mt-3">
            بازگشت
        </a>
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
                    @error('password')
                    <li> {{ $message }} </li> @enderror
                    @error('new_password')
                    <li> {{ $message }} </li> @enderror
                    @error('new_password_confirmation')
                    <li> {{ $message }} </li> @enderror
                </ul>
            </div>
        </div>
    @endif

    <script src="{{ asset('js/new-meeting-people.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
@endsection
