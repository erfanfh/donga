<form wire:submit="register" class="mt-8 grid grid-cols-6 gap-6">
    <div class="col-span-6 sm:col-span-3">
        <label for="FirstName" class="block text-sm font-medium text-gray-700">
            نام
        </label>

        <div class="mt-2">
            <input id="FirstName" wire:model="firstName" type="text"
                   class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('firstName') ? 'ring-red-500' : 'ring-gray-300' }} placeholder:text-gray-400 focus:ring-inset {{ $errors->has('firstName') ? 'focus:outline-0' : 'focus:outline-1' }} focus:outline-blue-600 sm:text-sm/6">
        </div>
        <div class="text-red-700">
            @error('firstName')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="col-span-6 sm:col-span-3">
        <label for="LastName" class="block text-sm font-medium text-gray-700">
            نام خانوادگی
        </label>

        <div class="mt-2">
            <input id="LastName" wire:model="lastName" type="text"
                                      class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('lastName') ? 'ring-red-500' : 'ring-gray-300' }} placeholder:text-gray-400 focus:ring-inset {{ $errors->has('lastName') ? 'focus:outline-0' : 'focus:outline-1' }} focus:outline-blue-600 sm:text-sm/6">
        </div>
        <div class="text-red-700">
            @error('lastName')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="col-span-6">
        <label for="Email" class="block text-sm font-medium text-gray-700"> ایمیل </label>

        <div class="mt-2">
            <input id="Email" wire:model.live="email" type="text" dir="ltr"
                                      class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('email') ? 'ring-red-500' : 'ring-gray-300' }} placeholder:text-gray-400 focus:ring-inset {{ $errors->has('email') ? 'focus:outline-0' : 'focus:outline-1' }} focus:outline-blue-600 sm:text-sm/6">
        </div>
        <div class="text-red-700">
            @error('email')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="col-span-6 sm:col-span-3">
        <label for="Password" class="block text-sm font-medium text-gray-700"> رمز عبور </label>

        <div class="mt-2">
            <input id="Password" wire:model.live="password" type="password" dir="ltr"
                                      class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('password') ? 'ring-red-500' : 'ring-gray-300' }} placeholder:text-gray-400 focus:ring-inset {{ $errors->has('password') ? 'focus:outline-0' : 'focus:outline-1' }} focus:outline-blue-600 sm:text-sm/6">
        </div>
        <div class="text-red-700">
            @error('password')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="col-span-6 sm:col-span-3">
        <label for="PasswordConfirmation" class="block text-sm font-medium text-gray-700">
            تکرار رمز عبور
        </label>

        <div class="mt-2">
            <input id="PasswordConfirmation" wire:model.live="password_confirmation" type="password" dir="ltr"
                                      class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('password_confirmation') ? 'ring-red-500' : 'ring-gray-300' }} placeholder:text-gray-400 focus:ring-inset {{ $errors->has('password_confirmation') ? 'focus:outline-0' : 'focus:outline-1' }} focus:outline-blue-600 sm:text-sm/6">
        </div>
        <div class="text-red-700">
            @error('password_confirmation')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="col-span-6">
        <label for="MarketingAccept" class="flex gap-4">
            <span class="text-sm text-gray-700">
             می‌خواهم ایمیل‌هایی درباره رویدادها، به‌روزرسانی‌های محصول و اطلاعیه‌های شرکت دریافت کنم.
            </span>

            <input
                type="checkbox"
                id="MarketingAccept"
                name="marketing_accept"
                class="size-5 rounded-md border-gray-200 bg-white shadow-sm"
            />
        </label>
    </div>

    <div class="col-span-6">
        <p class="text-sm text-gray-500">
            با ایجاد یک حساب کاربری، با
            <a href="#" class="text-gray-700 underline"> شرایط و ضوابط </a>
            و
            <a href="#" class="text-gray-700 underline">سیاست حفظ حریم خصوصی</a>
            ما موافقت می کنید.
        </p>
    </div>

    <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
        <button
            wire:click="register"
            class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
        >
            <span wire:loading.remove wire:target="register">ساخت حساب</span>
            <span wire:loading wire:target="register">
                <svg aria-hidden="true"
                     class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                     viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor"/>
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </span>
        </button>

        <p class="mt-4 text-sm text-gray-500 sm:mt-0">
            حساب دارید؟
            <a href="{{ route('login') }}" class="text-gray-700 underline">ورود</a>
        </p>
    </div>
</form>
