<form class="p-4 md:p-5" wire:submit="createTicket">
    <div class="grid gap-4 mb-4 grid-cols-2">
        <div class="col-span-2">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">عنوان</label>
            <input type="text" wire:model="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="مشکل در ایجاد دورهمی جدید">
            <div class="text-red-700">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-span-2 sm:col-span-1">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نوع</label>
            <select id="category" wire:model="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option selected>انتخاب کنید</option>
                <option value="1">پیشنهاد و انتقاد</option>
                <option value="2">گزارش باگ</option>
                <option value="3">ارتباط با مدیریت</option>
            </select>
            <div class="text-red-700">
                @error('category')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-span-2 sm:col-span-1">
            <label for="section" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">مربوط به</label>
            <select id="section" wire:model="section" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option selected="">انتخاب کنید</option>
                <option value="1">بخش فنی</option>
                <option value="2">بخش مالی</option>
                <option value="3">بخش مدیریت</option>
            </select>
            <div class="text-red-700">
                @error('section')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-span-2">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">توضیحات</label>
            <textarea id="description" wire:model="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="در اینجا مشکل یا پیام خود را شرح دهید"></textarea>
            <div class="text-red-700">
                @error('description')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <button class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        ایجاد
        <svg class="ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
    </button>
</form>
