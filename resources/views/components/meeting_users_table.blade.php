<div class="flex flex-col mt-6">
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="border rounded-lg overflow-hidden dark:border-neutral-700">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead class="bg-gray-100 dark:bg-neutral-700">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                            نام
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                            تاریخ عضویت
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                            تراز مالی
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                            وضعیت
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                            عملیات
                        </th>

                        <th scope="col"
                            class="flex justify-end px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">

                            <button type="button"
                                    class="flex items-center gap-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                    data-modal-target="add-user-modal" data-modal-toggle="add-user-modal">
                                افزودن
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                     fill="currentColor"
                                     class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                    <path
                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                    <path
                                        d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                                </svg>
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700 bg-white">
                    @foreach($meeting->persons as $person)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                {{ $person->name }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                {{ \Morilog\Jalali\Jalalian::fromCarbon($person->created_at)->format('Y/m/d') }}
                            </td>

                            @php
                                $textColor = match($person->status) {
                                    'creditor' => 'text-green-600',
                                    'debtor' => 'text-red-600',
                                    default => 'text-gray-800',
                                };

                                $enable = match($person->status) {
                                    'debtor' => ' ',
                                    default => 'disabled',
                                };

                                $balance = match($person->balance) {
                                    0 => ' ',
                                    default => 'disabled',
                                };

                                $status = match($person->status) {
                                    'creditor' => 'طلبکار',
                                    'debtor' => 'بدهکار',
                                    default => 'تسویه',
                                };
                            @endphp

                            <td class="px-6 py-4 whitespace-nowrap text-sm {{ $textColor }} dark:text-neutral-200">
                                {{ number_format($person->balance) }} تومان
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                {{ $status }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                <button type="button"
                                        {{ $enable }} data-modal-target="popup-modal-{{$person->id}}"
                                        data-modal-toggle="popup-modal-{{$person->id}}"
                                        class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">
                                    پرداخت
                                </button>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                <button type="button" data-modal-target="delete-user-modal-{{ $person->id }}"
                                        data-modal-toggle="delete-user-modal-{{ $person->id }}" {{ $balance }}
                                        class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </button>
                            </td>

                            <div id="delete-user-modal-{{ $person->id }}" tabindex="-1"
                                 class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <form action="{{ route('meetings.delete.user', $person) }}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="delete-user-modal-{{ $person->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-width="2"
                                                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <svg
                                                    class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-width="2"
                                                          d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                    آیا از حذف {{ $person->name }} اطمینان دارید؟
                                                </h3>
                                                <button data-modal-hide="delete-user-modal-{{ $person->id }}"
                                                        type="submit"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    بله، حذف کن!
                                                </button>
                                                <button data-modal-hide="delete-user-modal-{{ $person->id }}"
                                                        type="button"
                                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                    نه، منصرف شدم.
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            @if($enable != 'disabled')
                                <div id="popup-modal-{{$person->id}}" tabindex="-1"
                                     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button"
                                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="popup-modal-{{ $person->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-width="2"
                                                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                    مبلغ پرداختی {{$person->name}} را وارد کنید</h3>
                                                <form class="p-4 md:p-5 flex flex-col paymentForm"
                                                      action="{{ route('meetings.pay.user', $person) }}"
                                                      method="POST">
                                                    @csrf
                                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                                        <div class="col-span-2 flex flex-col items-start">
                                                            <label for="amount-{{ $person->id }}"
                                                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">مبلغ</label>
                                                            <input type="text" name="amount"
                                                                   id="amount-{{ $person->id }}"
                                                                   value="{{ old('price') }}"
                                                                   class="amount bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                   placeholder="حداکثر {{ number_format(-$person->balance) }} تومان">
                                                            @error('amount')
                                                            <div class="text-red-500">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-span-2 flex flex-col items-start">
                                                            <label for="creditor"
                                                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">پرداخت
                                                                به</label>
                                                            <select id="creditor" dir="rtl" name="creditor"
                                                                    class="bg-gray-50 border pe-5 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                @foreach($meeting->getCreditorsAttribute($meeting) as $creditor)
                                                                    <option name="user{{$creditor->name}}"
                                                                            value="{{$creditor->id}}">{{ $creditor->name . " ( طلب " . number_format($creditor->balance) . " تومان)" }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('creditor')
                                                            <div class="text-red-500">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <button type="submit"
                                                            class="flex gap-2 w-1/4 self-end text-white items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                        <p>ایجاد</p>
                                                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor"
                                                             viewBox="0 0 20 20"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                                  clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
