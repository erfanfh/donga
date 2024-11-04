@extends('Auth.master')
@section('title', 'ورود')
@section('content')
    <section class="bg-white">
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
            <aside class="relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-6">
                <img
                    alt=""
                    src="{{ asset('images/login.png') }}"
                    class="absolute inset-0 h-full w-full object-cover"
                />
            </aside>

            <main
                class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6"
            >
                <div class="w-2/3 max-w-xl lg:max-w-3xl">
                    <a class="text-blue-600 flex justify-center" href="/">
                        <img width="300" src="{{ asset('images/logo-nobg.png') }}" alt="لوگو دنگا">
                    </a>

                    <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                        ورود
                    </h1>

                    <form action="#" class="mt-8 grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <label for="Email" class="block text-sm font-medium text-gray-700"> ایمیل </label>

                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                            </div>
                        </div>

                        <div class="col-span-6">
                            <label for="Password" class="block text-sm font-medium text-gray-700"> رمز عبور </label>

                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                            </div>
                        </div>


                        <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
                            <button
                                class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
                            >
                                ورود به حساب
                            </button>

                            <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                                حساب ندارید؟
                                <a href="{{ route('register') }}" class="text-gray-700 underline">ثبت نام</a>
                            </p>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </section>
@endsection
