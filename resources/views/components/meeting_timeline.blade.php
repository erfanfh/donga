<ol class="relative border-s border-gray-200 dark:border-gray-700">
    @php
        use Illuminate\Support\Collection;

        $combined = $meeting->expenses->merge($meeting->payments)->sortByDesc('created_at');

    @endphp
    @foreach($combined as $item)
        @if($item instanceof \App\Models\Payment)
            <li class="mb-10 ms-4">
                <div
                    class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                <time
                    class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ \Morilog\Jalali\Jalalian::fromCarbon($item->created_at)->format('H:i Y/m/d') }}</time>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white"></h3>
                <span
                    class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ number_format($item->amount) }} تومان پرداخت شد</span>
                <p class="py-3">
                    از:
                    <span
                        class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $item->person->name }}</span>
                </p>
                <p>
                    به:
                    <span
                        class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $item->creditor->name }}</span>
                </p>
            </li>
        @else
            <li class="mb-10 ms-4">
                <div
                    class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                <time
                    class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ \Morilog\Jalali\Jalalian::fromCarbon($item->created_at)->format('H:i Y/m/d') }}</time>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $item->name }}</h3>
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ $item->description }}</p>
                <span
                    class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ number_format($item->price) }} تومان خرج شد</span>
                <p class="py-3">
                    از:
                    <span
                        class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $item->person->name }}</span>
                </p>
                <p>برای:
                    @foreach($item->persons as $person)
                        <span
                            class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $person->name }}</span>
                    @endforeach
                </p>
            </li>
        @endif
    @endforeach
</ol>
