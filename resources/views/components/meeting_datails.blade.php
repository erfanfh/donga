<div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5 mt-5">
    <div
        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            خرج {{ $meeting->title }}</h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">{{ number_format($meeting->expenses()->sum('price')) }}
            تومان</p>
    </div>

    <div
        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">تعداد افراد</h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">{{ $meeting->persons()->count() }} نفر</p>
    </div>

    <div
        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            طول {{ $meeting->title }}</h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">{{ ceil($meeting->created_at->diffInDays(now())) }}
            روز </p>
    </div>

    <button type="button"
            class="flex flex-col items-center justify-evenly max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
            aria-label="Add new record"
            data-modal-target="create-expense-modal" data-modal-toggle="create-expense-modal">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-lg"
             viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                  d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
        </svg>
        <span class="text-sm font-medium">ایجاد خرج جدید</span>
    </button>
</div>
