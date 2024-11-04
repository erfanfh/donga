<form wire:submit="register" class="mt-8 grid grid-cols-6 gap-6">
    <div class="col-span-6 sm:col-span-3">
        <label for="FirstName" class="block text-sm font-medium text-gray-700">
            نام
        </label>

        <div class="mt-2">
            <input id="email" wire:model="firstName" type="text" autocomplete="email"
                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
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
            <input id="email" wire:model="lastName" type="text" autocomplete="email"
                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
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
            <input id="email" wire:model.live="email" type="email" autocomplete="email"
                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
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
            <input id="email" wire:model.live="password" type="password" autocomplete="email"
                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
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
            <input id="email" wire:model.live="password_confirmation" type="password" autocomplete="email"
                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
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
            class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
        >
            ساخت حساب
        </button>

        <p class="mt-4 text-sm text-gray-500 sm:mt-0">
            حساب دارید؟
            <a href="{{ route('login') }}" class="text-gray-700 underline">ورود</a>
        </p>
    </div>
</form>
