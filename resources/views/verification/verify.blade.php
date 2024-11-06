@extends('verification.master')

@section('content')
<main class="relative min-h-screen flex flex-col justify-center bg-slate-50 overflow-hidden">
    <div class="w-full max-w-6xl mx-auto px-4 md:px-6 py-24">
        <div class="flex justify-center">

            <div class="max-w-md mx-auto text-center bg-white px-4 sm:px-8 py-10 rounded-xl shadow">
                <header class="mb-8">
                    <h1 class="text-2xl font-bold mb-1">تایید ایمیل</h1>
                    <p class="text-[15px] text-slate-500">کد 4 رقمی ارسال شده به ایمیل </p>
                    <p class="text-[15px] text-slate-500">{{ auth()->user()->email }}</p>
                    <p class="text-[15px] text-slate-500">.را وارد کنید</p>
                </header>
                <form id="otp-form" action="{{ route('verify.post') }}" method="POST">
                    @csrf
                    <div class="flex items-center justify-center gap-3">
                        <input type="text" name="char1" autocomplete="off"
                               class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                               pattern="\d*" maxlength="1">
                        <input type="text" name="char2" autocomplete="off"
                               class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                               maxlength="1">
                        <input type="text" name="char3" autocomplete="off"
                               class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                               maxlength="1">
                        <input type="text" name="char4" autocomplete="off"
                               class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                               maxlength="1">
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
                <div class="text-sm text-slate-500 mt-4">کدی دریافت نکردید؟<a
                            class="font-medium text-indigo-500 hover:text-indigo-600" href="{{ route('verify.resend') }}">ارسال دوباره</a></div>
                <div class="text-sm text-slate-500 mt-4">ایمیل اشتباه است؟<a
                            class="font-medium text-indigo-500 hover:text-indigo-600" href="{{ route('verify.change-email') }}">تغییر ایمیل</a></div>
            </div>
        </div>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('otp-form')
        const inputs = [...form.querySelectorAll('input[type=text]')]
        const submit = form.querySelector('button[type=submit]')

        const handleKeyDown = (e) => {
            if (
                !/^[0-9]$/.test(e.key)
                && e.key !== 'Backspace'
                && e.key !== 'Delete'
                && e.key !== 'Tab'
                && !e.metaKey
            ) {
                e.preventDefault()
            }

            if (e.key === 'Delete' || e.key === 'Backspace') {
                const index = inputs.indexOf(e.target);
                if (index > 0) {
                    inputs[index - 1].value = '';
                    inputs[index - 1].focus();
                }
            }
        }

        const handleInput = (e) => {
            const {target} = e
            const index = inputs.indexOf(target)
            if (target.value) {
                if (index < inputs.length - 1) {
                    inputs[index + 1].focus()
                } else {
                    submit.focus()
                }
            }
        }

        const handleFocus = (e) => {
            e.target.select()
        }

        const handlePaste = (e) => {
            e.preventDefault()
            const text = e.clipboardData.getData('text')
            if (!new RegExp(`^[0-9]{${inputs.length}}$`).test(text)) {
                return
            }
            const digits = text.split('')
            inputs.forEach((input, index) => input.value = digits[index])
            submit.focus()
        }

        inputs.forEach((input) => {
            input.addEventListener('input', handleInput)
            input.addEventListener('keydown', handleKeyDown)
            input.addEventListener('focus', handleFocus)
            input.addEventListener('paste', handlePaste)
        })
    })
</script>
@endsection
