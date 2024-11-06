@extends('auth.master')
@section('title', 'ثبت نام')
@section('content')
    <section class="bg-white">
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
            <aside class="relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-6">
                <img
                    alt=""
                    src="{{ asset('images/register.png') }}"
                    class="absolute inset-0 h-full w-full object-cover"
                />
            </aside>

            <main
                class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6"
            >
                <div class="max-w-xl lg:max-w-3xl">
                    <a class="text-blue-600 flex justify-center" href="/">
                        <img width="300" src="{{ asset('images/logo-nobg.png') }}" alt="لوگو دنگا">
                    </a>

                    <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                        خوش آمدید
                    </h1>

                    <p class="mt-4 leading-relaxed text-gray-500">
                    </p>

                    <livewire:register/>
                </div>
            </main>
        </div>
    </section>
@endsection
