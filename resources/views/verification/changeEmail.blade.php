@extends('verification.master')

@section('title', 'تغییر ایمیل')

@section('content')
<main class="relative min-h-screen flex flex-col justify-center bg-slate-50 overflow-hidden">
        <div class="w-full max-w-6xl mx-auto px-4 md:px-6 py-24">
            <div class="flex justify-center">

                <div class="w-full max-w-md mx-auto text-center bg-white px-4 sm:px-8 py-10 rounded-xl shadow">
                    <header class="mb-8">
                        <h1 class="text-2xl font-bold mb-1">تغییر ایمیل</h1>
                    </header>
                    <form id="otp-form" action="{{ route('verify.change-email.post') }}" method="POST">
                        @csrf
                        <div class="col-span-6">
                            <label for="Email" class="block text-sm font-medium text-gray-700 sr-only"> ایمیل </label>

                            <div class="mt-2">
                                <input id="Email" name="email" type="text" autocomplete="email" dir="ltr"
                                       class="block w-full rounded-md border border-transparent bg-slate-100 hover:border-slate-200 bg- appearance-none p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                       placeholder="{{ auth()->user()->email }}"
                                >
                            </div>

                            <div class="text-red-700">
                                @error('email')
                                {{ $message }}
                                @enderror
                            </div>
                        @if(session()->has('error'))
                            <div class="bg-red-50 mt-5 border-e-4 border-red-500 p-4 dark:bg-red-800/30" role="alert" tabindex="-1"
                                 aria-labelledby="hs-bordered-red-style-label">
                                <div class="flex">
                                    <div class="ms-3">
                                        <h3 id="hs-bordered-red-style-label"
                                            class="text-gray-800 font-semibold dark:text-white text-right">
                                            خطا
                                        </h3>
                                        <p class="text-sm text-gray-700 dark:text-neutral-400 text-right">
                                            {{ session('error') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="max-w-[260px] mx-auto mt-4">
                            <button type="submit"
                                    class="w-full inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500">
                                ارسال
                            </button>
                        </div>
                    </form>
                    <div class="text-sm text-slate-500 mt-4">منصرف شدید؟<a
                            class="font-medium text-indigo-500 hover:text-indigo-600" href="{{ route('verify') }}">بازگشت</a></div>
                </div>
            </div>
        </div>
    </main>
@endsection
